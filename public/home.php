<?php
include_once "../utils/autoloader.php";

require_once './asset/partials/header.php';
$heroRepo = new HeroRepository;
$monsterRepo = new MonsterRepository;
$fightManager = new FightsManager;


$heroes = [
    $hero1 = new Hero(1, "trapo", 35, 25),
    $hero2 = new Hero(2, "sirene", 40, 20),
];
var_dump($heroes);

$monster = new Monster(1, "karlito", 10, 3);

// var_dump($monster);

// $fightManager->startFight($hero, $monster);

// var_dump($hero);
// var_dump($monster);
?>

<main>
    <section class="flex">
            <?php foreach ($heroes as $hero) :  ?>
            <form action="./fight.php?id=<?= $hero->getId()?>" method="post" class="card">
                <input type="radio" name="<?= htmlspecialchars($hero->getName())?>" value="<?= $hero->getId()?>" id="">
                <h1><?= htmlspecialchars($hero->getName())?></h1>
                <h2>CLASS</h2>
                <p><?= htmlspecialchars($hero->getPv())?></p>
                <p><?= htmlspecialchars($hero->getAttack())?> / <?= htmlspecialchars($hero->getDefense())?></p>
                <input type="submit" value="selectionner le personnage"></input>
            </form>
            <?php  endforeach ?>
    </section>
</main>

<!-- <a href="https://pokemondb.net/pokedex/charizard"><img src="https://img.pokemondb.net/sprites/black-white/normal/charizard.png" alt="Charizard"></a>
 <a href="https://pokemondb.net/pokedex/mewtwo"><img src="https://img.pokemondb.net/sprites/black-white/normal/mewtwo.png" alt="Mewtwo"></a>
<a href="https://pokemondb.net/pokedex/blastoise"><img src="https://img.pokemondb.net/sprites/black-white/normal/blastoise.png" alt="Blastoise"></a> -->


<?php
require_once './asset/partials/footer.php'
?>