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
                GROUP_CONCAT(s.id) AS skill_ids,
                GROUP_CONCAT(s.name) AS skill_names,
                GROUP_CONCAT(s.attack) AS skill_attacks,
                GROUP_CONCAT(s.effect) AS skill_effects
            FROM monster m
            LEFT JOIN monster_skill ms ON m.id = ms.id_monster
            LEFT JOIN skill s ON ms.id_skill = s.id
            WHERE m.id = :id
            GROUP BY m.id
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($data) {
            // Mapper les données du monstre
            $monster = MonsterMapper::mapToObject($data);
    
            // Mapper les compétences
            if (!empty($data['skill_ids'])) {
                $skillIds = explode(',', $data['skill_ids']);
                $skillNames = explode(',', $data['skill_names']);
                $skillAttacks = explode(',', $data['skill_attacks']);
                $skillEffects = explode(',', $data['skill_effects']);
    
                $skills = [];
                for ($i = 0; $i < count($skillIds); $i++) {
                    $skills[] = new Skill(
                        (int)$skillIds[$i],
                        $skillNames[$i],
                        (int)$skillAttacks[$i],
                        $skillEffects[$i]
                    );
                }
    
                $monster->setSkills($skills);
            }
    
            return $monster;
        }
    
        return null;
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
