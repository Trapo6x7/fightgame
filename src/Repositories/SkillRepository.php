<?php

final class SkillRepository extends AbstractRepository {

    protected SkillMapper $mapper;
    
    public function findById(int $id): ?Skill
    {
        $sql = "SELECT * FROM `skill` WHERE id = :id";

        try {

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id" => $id
            ]);
            $skillData = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            echo "Erreur lors de la requete : " . $error->getMessage();
        }

        $skill = $this->mapper->mapToObject($skillData);

        if ($skill) {
            return $skill;
        } else {
            return null;
        }
    }

    public function findByPartnerId(int $partnerId): array
    {
        $query = $this->pdo->prepare("
            SELECT skill.*
            FROM skill
            INNER JOIN partner_skill ON skill.id = partner_skill.id_skill
            WHERE partner_skill.id_partner = :id_partner
        ");
        $query->execute(['id_partner' => $partnerId]);
        $results = $query->fetchAll();

        $skills = [];
        foreach ($results as $result) {
            $skills[] = SkillMapper::mapToObject($result);
        }

        return $skills;
    }
    
    public function findByMonsterId(int $monsterId): array
    {
        $query = $this->pdo->prepare("
            SELECT skill.*
            FROM skill
            INNER JOIN monster_skill ON skill.id = monster_skill.id_skill
            WHERE monster_skill.id_monster = :id_monster
        ");
        $query->execute(['id_monster' => $monsterId]);
        $results = $query->fetchAll();

        $skills = [];
        foreach ($results as $result) {
            $skills[] = SkillMapper::mapToObject($result);
        }

        return $skills;
    }

    public function insert(string $name, int $attack, ?string $effect): int
    {
        // Prépare la requête d'insertion
        $query = $this->pdo->prepare("
            INSERT INTO skill (name, attack, effect)
            VALUES (:name, :attack, :effect)
        ");

        // Exécute la requête avec les données de la compétence
        return $query->execute([
            'name' => $name,
            'attack' => $attack,
            'effect' => $effect,
        ]);
    }
}
