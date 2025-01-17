<?php
final class MonsterRepository extends AbstractRepository
{
    private MonsterMapper $mapper;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new MonsterMapper();
    }

    public function findAll(): array
    {
        $query = "SELECT * FROM monster";
        $stmt = $this->pdo->query($query);
        $monsterDatas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $monsters = [];
        foreach ($monsterDatas as $monsterData) {
            $monsters[] = MonsterMapper::mapToObject($monsterData);
        }

        return $monsters;
    }

    public function findById(string $id): ?Monster
    {
        $sql = "SELECT * FROM monster WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $monsterData = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            echo "Erreur lors de la requête : " . $error->getMessage();
            return null;
        }

        return $monsterData ? MonsterMapper::mapToObject($monsterData) : null;
    }

    public function insert(Monster $monster): ?int
    {

        var_dump($monster);
   
        $sql = "INSERT INTO monster ( name, pv, attack, defense, is_alive, image_url, ferocity)
                VALUES ( :name, :pv, :attack, :defense, :is_alive, :image_url, :ferocity);";

        try {
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':name', $monster->getName(), PDO::PARAM_STR);
            $stmt->bindValue(':pv', $monster->getPv(), PDO::PARAM_INT);
            $stmt->bindValue(':attack', $monster->getAttack(), PDO::PARAM_INT);
            $stmt->bindValue(':defense', $monster->getDefense(), PDO::PARAM_INT);
            $stmt->bindValue(':is_alive', $monster->getIsAlive(), PDO::PARAM_BOOL);
            $stmt->bindValue(':image_url', $monster->getImageUrl(), PDO::PARAM_STR);
            $stmt->bindValue(':ferocity', $monster->getFerocity(), PDO::PARAM_STR);

            $stmt->execute();

            $monsterId = $this->pdo->lastInsertId();

            return $monsterId;

        } catch (PDOException $error) {
            echo "Erreur lors de la requête : " . $error->getMessage();
            return null;
        }
    }
}
