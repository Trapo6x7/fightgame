<?php

class MonsterRepository extends AbstractRepository
{
    protected MonsterMapper $mapper;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new MonsterMapper();
    }

    public function findById(int $id): ?Monster
    {
        $query = "
            SELECT 
                m.id, m.name, m.attack, m.defense, m.image_url, m.pv, m.ferocity, m.difficulty_level,
                s.id AS skill_id, s.name AS skill_name, s.attack AS skill_attack, s.effect AS skill_effect
            FROM monster m
            LEFT JOIN monster_skill ms ON m.id = ms.id_monster
            LEFT JOIN skill s ON ms.id_skill = s.id
            WHERE m.id = :id
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }

        // Map les compétences
        $skills = [];
        foreach ($results as $row) {
            if (!empty($row['skill_id'])) {
                $skills[] = new Skill(
                    $row['skill_id'],
                    $row['skill_name'],
                    $row['skill_attack'],
                    $row['skill_effect']
                );
            }
        }

        // Map le monstre
        $monsterData = $results[0]; // Les données du monstre sont identiques sur chaque ligne
        return new Monster(
            $monsterData['id'],
            $monsterData['name'],
            $monsterData['attack'],
            $monsterData['defense'],
            $monsterData['image_url'],
            $monsterData['pv'],
            $monsterData['ferocity'],
            $skills, 
            $monsterData['difficulty_level'],
        );
    }

    public function insert(
        int $pv,
        string $name,
        int $attack,
        int $defense,
        string $imageUrl,
        int $ferocity,
        int $difficultyLevel,
        array $skills
    ): int {
        $sql = "
            INSERT INTO `monster` (`pv`, `name`, `attack`, `defense`, `image_url`, `ferocity`, `difficulty_level`) 
            VALUES (:pv, :name, :attack, :defense, :image_url, :ferocity, :difficulty_level)
        ";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":pv" => $pv,
                ":name" => $name,
                ":attack" => $attack,
                ":defense" => $defense,
                ":image_url" => $imageUrl,
                ":ferocity" => $ferocity,
                ":difficulty_level" => $difficultyLevel,
            ]);

            $monsterId = (int) $this->pdo->lastInsertId();

            // Insérer les compétences dans la table pivot
            foreach ($skills as $skillId) {
                $pivotSql = "INSERT INTO monster_skill (id_monster, id_skill) VALUES (:id_monster, :id_skill)";
                $pivotStmt = $this->pdo->prepare($pivotSql);
                $pivotStmt->execute([
                    ":id_monster" => $monsterId,
                    ":id_skill" => $skillId,
                ]);
            }

            return $monsterId;
        } catch (PDOException $error) {
            echo "Erreur lors de l'insertion : " . $error->getMessage();
            return 0;
        }
    }
}
