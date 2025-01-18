<?php

class HeroRepository extends AbstractRepository
{
    protected HeroMapper $mapper;
    
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

        $hero = $this->mapper->mapToObject($heroData);

        if ($hero) {
            return $hero;
        } else {
            return null;
        }
    }

    public function insert(string $name, int $partnerId): int
    {
        $sql = "INSERT INTO `hero` (`name`, `id_partner`, `is_alive`) VALUES (:name, :id_partner, :is_alive)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':id_partner' => $partnerId,
                ':is_alive' => true,
            ]);
            return (int) $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return 0;
        }
    }
}
