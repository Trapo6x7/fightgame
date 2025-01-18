<?php

final class SkillRepository extends AbstractRepository {

    public function findByPartnerId(int $partnerId): array
    {
        $query = $this->pdo->prepare("
            SELECT skills.*
            FROM skills
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

    public function insert(Skill $skill): bool
    {
        // Prépare la requête d'insertion
        $query = $this->pdo->prepare("
            INSERT INTO skills (name, attack, effect)
            VALUES (:name, :attack, :effect)
        ");

        // Exécute la requête avec les données de la compétence
        return $query->execute([
            'name' => $skill->getName(),
            'attack' => $skill->getAttack(),
            'effect' => $skill->getEffect()
        ]);
    }
}
