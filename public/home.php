<?php
include_once "../utils/autoloader.php";

require_once './asset/partials/header.php';
$heroRepo = new HeroRepository;
$monsterRepo = new MonsterRepository;
$fightManager = new FightsManager;



// $monsterKaaris= new Monster(1, "kaaris", 60, 20, "https://diffusionph.cccommunication.biz/jpgok/RepGR/747/747512_2.jpg", 100);
// $kaarisInser = $monsterRepo->insert($monsterKaaris);

// $hero= new Hero(1, "sirene", 40, 30, "", "heal");
// $heroInser = $heroRepo->insert($hero);


?>

<!-- $fightManager->displayHero() -->

<?php
require_once './asset/partials/footer.php'
?>
<!-- <a href="https://pokemondb.net/pokedex/charizard"><img src="https://img.pokemondb.net/sprites/black-white/normal/charizard.png" alt="Charizard"></a>
 <a href="https://pokemondb.net/pokedex/mewtwo"><img src="https://img.pokemondb.net/sprites/black-white/normal/mewtwo.png" alt="Mewtwo"></a>
<a href="https://pokemondb.net/pokedex/blastoise"><img src="https://img.pokemondb.net/sprites/black-white/normal/blastoise.png" alt="Blastoise"></a> -->
