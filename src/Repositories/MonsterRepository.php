<?php

class MonsterRepository extends AbstractRepository
{
    protected MonsterMapper $mapper;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new MonsterMapper;
    }
    public function findById(int $id): ?Monster
    {
        $query = "SELECT id, name, attack, defense, image_url, pv, ferocity, difficulty_level FROM `monster` WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($data) {
            return MonsterMapper::mapToObject($data);
        }
    
        return null;
    }
    
    public function insert(int $pv, string $name, int $attack, int $defense, string $imageUrl, int $ferocity, int $difficultyLevel) : int
    {
        $sql = "INSERT INTO `monster` (`pv`, `name`, `attack`, `defense`, `image_url`, `ferocity`, `difficulty_level`) 
        VALUES (:pv, :name, :attack, :defense, :image_url, :ferocity, :difficulty_level)";

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
            return (int) $this->pdo->lastInsertId();
        } catch (PDOException $error) {
            echo "Erreur lors de la requete: " . $error->getMessage();
        }
    }
}
