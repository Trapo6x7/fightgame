<?php

class PartnerRepository extends AbstractRepository
{
    protected PartnerMapper $mapper;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new PartnerMapper;
    }

    public function findById(int $id): ?Partner
    {
        $sql = "SELECT * FROM `partner` WHERE id = :id";

        try {

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id" => $id
            ]);
            $partnerData = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            echo "Erreur lors de la requete : " . $error->getMessage();
        }

        $partner = $this->mapper->mapToObject($partnerData);

        if ($partner) {
            return $partner;
        } else {
            return null;
        }
    }

    public function insert(int $pv, string $name, int $attack, int $defense, string $imageUrl, int $level) : int
    {
        $sql = "INSERT INTO `partner` (`pv`, `name`, `attack`, `defense`, `image_url`, `level`) 
        VALUES (:pv, :name, :attack, :defense, :image_url, :level)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":pv" => $pv,
                ":name" => $name,
                ":attack" => $attack,
                ":defense" => $defense,
                ":image_url" => $imageUrl,
                ":level" => $level,
            ]);
            return (int) $this->pdo->lastInsertId();
        } catch (PDOException $error) {
            echo "Erreur lors de la requete: " . $error->getMessage();
        }
    }
}
