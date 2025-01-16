<?php

final class HeroRepository extends AbstractRepository
{


    private HeroMapper $mapper;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new HeroMapper;
    }

    
    public function findAll(): array
    {
        $query = "SELECT * FROM `character`";
        $stmt = $this->pdo->query($query);
        $characterDatas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($characterDatas as $characterData) {
            $characters[] = HeroMapper::mapToObject($characterData);
        }

        return $characters;
    }
    

    public function findById(string $id): ?Hero
    {
        $sql = "SELECT * FROM `character` WHERE id = :id";

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

    public function insert(int $id, string $name, int $pv = 100, int $attack, int $defense, bool $isAlive = true): ?int
    {
        // Utilisation des backticks pour entourer le nom de la table
        $sql = "INSERT INTO `character` (id, name, pv, attack, defense, is_alive)
                VALUES (:id, :name, :pv, :attack, :defense, :is_alive);";
    
        try {
            // Préparer la requête SQL
            $stmt = $this->pdo->prepare($sql);
    
            // Associer les paramètres avec les valeurs passées en argument
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':pv', $pv, PDO::PARAM_INT);
            $stmt->bindParam(':attack', $attack, PDO::PARAM_INT);
            $stmt->bindParam(':defense', $defense, PDO::PARAM_INT);
            $stmt->bindParam(':is_alive', $isAlive, PDO::PARAM_BOOL);
    
            // Exécuter la requête
            $stmt->execute();
    
            // Retourner l'ID du personnage inséré
            return (int) $this->pdo->lastInsertId();
        } catch (PDOException $error) {
            // Afficher l'erreur en cas de problème
            echo "Erreur lors de la requête : " . $error->getMessage();
            return null; // Retourne null en cas d'erreur
        }
    }
    
}
