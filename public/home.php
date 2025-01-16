<?php
include_once "../utils/autoloader.php";

require_once './asset/partials/header.php';
$heroRepo = new HeroRepository;
$monsterRepo = new MonsterRepository;
$fightManager = new FightsManager;
?>

<?= $fightManager->displayHero(); ?>

<?php
require_once './asset/partials/footer.php'
?>
<!-- <a href="https://pokemondb.net/pokedex/charizard"><img src="https://img.pokemondb.net/sprites/black-white/normal/charizard.png" alt="Charizard"></a>
 <a href="https://pokemondb.net/pokedex/mewtwo"><img src="https://img.pokemondb.net/sprites/black-white/normal/mewtwo.png" alt="Mewtwo"></a>
<a href="https://pokemondb.net/pokedex/blastoise"><img src="https://img.pokemondb.net/sprites/black-white/normal/blastoise.png" alt="Blastoise"></a> -->
