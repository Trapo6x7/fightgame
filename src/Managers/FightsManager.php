<?php
include_once "../utils/autoloader.php";


class FightsManager
{

    private HeroRepository $heroRepository;
    private MonsterRepository $monsterRepository;

    public function __construct()
    {
        $this->heroRepository = new HeroRepository;
        $this->monsterRepository = new MonsterRepository;
    }

    public function displayHero()
    {
        ob_start() ?>

        <main>
            <section class="flex">
                <?php foreach ($this->heroRepository->findAll() as $hero) :  ?>
                    <img class="imageselect" src="<?= $hero->getimageUrl() ?>" alt="">
                    <form action="./fight.php?id=<?= $hero->getId() ?>" method="post" class="card">
                        <input type="radio" name="<?= htmlspecialchars($hero->getName()) ?>" value="<?= $hero->getId() ?>" id="">
                        <h1><?= htmlspecialchars($hero->getName()) ?></h1>
                        <h2>CLASS</h2>
                        <p><?= htmlspecialchars($hero->getPv()) ?></p>
                        <p><?= htmlspecialchars($hero->getAttack()) ?> / <?= htmlspecialchars($hero->getDefense()) ?></p>
                        <input type="submit" value="selectionner le personnage"></input>
                    </form>
                <?php endforeach ?>
            </section>
            <section>
                <form action="./home.php" method="post">
                    
                <!-- https://i.pinimg.com/736x/74/aa/81/74aa81e3a2526bdbce75fdacfba7a043.jpg -->
                </form>
            </section>
        </main>

<?php
        return ob_get_clean();
    }

    public function displayFight()
    {
        ob_start() ?>

       

<?php
        return ob_get_clean();
    }


    public function startFight(Hero $hero, Monster $monster): void
    {
        echo "<br> Le combat commence entre {$hero->getName()} et {$monster->getName()} ! ";

        while ($hero->getIsAlive() && $monster->getIsAlive()) {
            // Tour du héros
            $this->executeTurn($hero, $monster);
            if (!$monster->getIsAlive()) {
                echo "<br> {$hero->getName()} a gagné !\n";
                break;
            }

            // Tour du monstre
            $this->executeTurn($monster, $hero);
            if (!$hero->getIsAlive()) {
                echo "<br> {$monster->getName()} a gagné !\n";
                break;
            }
        }
    }

    // Exécution d'un tour de combat
    private function executeTurn(Character $attacker, Character $defender): void
    {
        $damage = max(0, $attacker->getAttack() - $defender->getDefense());
        $defender->takeDamage($damage);
        if ($defender->getDefense() < $attacker->getAttack()) {
            echo "<br> {$attacker->getName()} attaque {$defender->getName()} et inflige $damage dégâts!\n";
            echo "<br> {$defender->getName()} a maintenant {$defender->getPv()} PV.\n";
        } else {
            echo "<br> {$attacker->getName()} attaque {$defender->getName()} mais rien ne se passe!\n";
        }
    }

    public function processAjaxAction(int $heroId, string $action)
{
    $hero = $this->heroRepository->findById($heroId);
    $monster = $this->monsterRepository->getCurrentMonster(); // Implémente une méthode pour récupérer le monstre actif

    if (!$hero || !$monster) {
        return ['error' => 'Héros ou monstre introuvable'];
    }

    switch ($action) {
        case 'attack':
            $this->executeTurn($hero, $monster);
            break;

        case 'defend':
            $hero->increaseDefense(5); // Méthode à ajouter dans `Hero`
            break;

        default:
            return ['error' => 'Action non reconnue'];
    }

    // Tour du monstre
    $this->executeTurn($monster, $hero);

    return [
        'message' => 'Tour terminé',
        'state' => [
            'hero' => [
                'name' => $hero->getName(),
                'pv' => $hero->getPv(),
                'defense' => $hero->getDefense(),
            ],
            'monster' => [
                'name' => $monster->getName(),
                'pv' => $monster->getPv(),
                'defense' => $monster->getDefense(),
            ],
        ],
    ];
}
}
