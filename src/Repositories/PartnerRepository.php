<?php

class PartnerRepository extends AbstractRepository
{
    protected PartnerMapper $mapper;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new PartnerMapper;
    }

    /**
     * Récupère un partenaire avec ses compétences à partir de son ID.
     */
    public function findById(int $id): ?Partner
    {
        $query = "
            SELECT p.id, p.name, p.attack, p.defense, p.image_url, p.pv, p.level,
                   GROUP_CONCAT(s.id) AS skill_ids, GROUP_CONCAT(s.name) AS skill_names, 
                   GROUP_CONCAT(s.attack) AS skill_attacks, GROUP_CONCAT(s.effect) AS skill_effects
            FROM `partner` p
            LEFT JOIN `partner_skill` ps ON p.id = ps.id_partner
            LEFT JOIN `skill` s ON ps.id_skill = s.id
            WHERE p.id = :id
            GROUP BY p.id
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return PartnerMapper::mapToObject($data);
        }

        return null;
    }

    /**
     * Insère un partenaire dans la base de données et associe ses compétences.
     */
    public function insert(int $pv, string $name, int $attack, int $defense, string $imageUrl, int $level, array $skills): int
    {
        $this->pdo->beginTransaction();
        try {
            // Insertion du partenaire
            $sql = "INSERT INTO `partner` (`pv`, `name`, `attack`, `defense`, `image_url`, `level`) 
                    VALUES (:pv, :name, :attack, :defense, :image_url, :level)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":pv" => $pv,
                ":name" => $name,
                ":attack" => $attack,
                ":defense" => $defense,
                ":image_url" => $imageUrl,
                ":level" => $level,
            ]);
            $partnerId = (int) $this->pdo->lastInsertId();

            // Association des compétences via la table partner_skill
            $sqlSkill = "INSERT INTO `partner_skill` (`id_partner`, `id_skill`) VALUES (:id_partner, :id_skill)";
            $stmtSkill = $this->pdo->prepare($sqlSkill);

            foreach ($skills as $skillId) {
                $stmtSkill->execute([
                    ":id_partner" => $partnerId,
                    ":id_skill" => $skillId,
                ]);
            }

            $this->pdo->commit();
            return $partnerId;
        } catch (PDOException $error) {
            $this->pdo->rollBack();
            echo "Erreur lors de la requête : " . $error->getMessage();
            return 0;
        }
    }
}
