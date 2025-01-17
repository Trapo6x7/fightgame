<?php 
final class HeroRepository extends AbstractRepository
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

        $heroes = [];
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
            $stmt->execute([':id' => $id]);
            $heroData = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            echo "Erreur lors de la requête : " . $error->getMessage();
            return null;
        }

        return $heroData ? HeroMapper::mapToObject($heroData) : null;
    }

    public function insert(Hero $hero): ?int
    {
        $sql = "INSERT INTO hero (name, attack, defense, pv, is_alive, image_url, special_skill)
                VALUES (:name, :attack, :defense, :pv, :is_alive, :image_url, :special_skill)";
    
        try {
            $stmt = $this->pdo->prepare($sql);
    
            // Bind des paramètres
            $stmt->bindValue(':name', $hero->getName(), PDO::PARAM_STR);
            $stmt->bindValue(':attack', $hero->getAttack(), PDO::PARAM_INT);
            $stmt->bindValue(':defense', $hero->getDefense(), PDO::PARAM_INT);
            $stmt->bindValue(':pv', $hero->getPv(), PDO::PARAM_INT);
            $stmt->bindValue(':is_alive', $hero->getIsAlive(), PDO::PARAM_BOOL);
            $stmt->bindValue(':image_url', $hero->getImageUrl(), PDO::PARAM_STR);
            $stmt->bindValue(':special_skill', $hero->getSpecialSkill(), PDO::PARAM_STR);
    
            // Exécution de la requête
            $stmt->execute();
    
            // Récupérer l'ID généré après l'insertion
            $heroId = $this->pdo->lastInsertId();

    
            // Retourner l'ID du héros inséré
            return $heroId;
        } catch (PDOException $error) {
            echo "Erreur lors de l'insertion du héros : " . $error->getMessage();
            return null;
        }
    }
}
