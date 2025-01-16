<?php

final class HeroesRepository extends AbstractRepository
{


    private HeroMapper $mapper;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new HeroMapper();
    }

    
    public function findAll(): array
    {
        $query = "SELECT * FROM hero";
        $stmt = $this->pdo->query($query);
        $heroDatas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($heroDatas as $heroData) {
            $heroes[] = HeroMapper::mapToObject($heroData);
        }

        return $heroes;
    }
    

    public function findById(string $id): ?Hero
    {
        $sql = "SELECT * FROM hero WHERE id = :id";

        try {

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id" => $id
            ]);
            $heroData = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            echo "Erreur lors de la requete : " . $error->getMessage();
        }

        $hero = HeroMapper::mapToObject($heroData);

        if ($hero) {
            return $hero;
        } else {
            return null;
        }
    }

}
