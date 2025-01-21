<?php

class HeroRepository extends AbstractRepository
{
    private PartnerRepository $partnerRepo;

    public function __construct()
    {
        parent::__construct();
        $this->partnerRepo = new PartnerRepository();
    }

    public function findById(int $id): ?Hero
    {
        $sql = "SELECT * FROM `hero` WHERE id = :id";

        try {

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id" => $id
            ]);
            $heroData = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {
            echo "Erreur lors de la requete : " . $error->getMessage();
        }

        // ICI j'ai mes data de hero, je recupere son partner
        $partner = $this->partnerRepo->findById($heroData['id_partner']);


        unset($heroData['id_partner']);
        $heroData['partner'] = $partner;

        $hero = HeroMapper::mapToObject($heroData);
        

        if ($hero) {
            return $hero;
        } else {
            return null;
        }
    }

    public function insert(Hero $hero): Hero
    {
        $sql = "INSERT INTO `hero` (`name`, `id_partner`, `is_alive`) VALUES (:name, :id_partner, :is_alive)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':name' => $hero->getName(),
                ':id_partner' => $hero->getPartner()->getId(),
                ':is_alive' => $hero->getIsAlive(),
            ]);

            return $this->findById($this->pdo->lastInsertId());
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return 0;
        }
    }
}
