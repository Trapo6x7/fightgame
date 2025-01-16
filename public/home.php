<?php

include_once "../utils/autoloader.php";

$db= new CharacterRepository;
$fightManager= new FightsManager;

$hero = new Hero(1, "trapo", 35, 25);

var_dump($hero);

$monster = new Monster(1, "karlito", 10, 3);

var_dump($monster);

$fightManager->startFight($hero, $monster);

var_dump($hero);
var_dump($monster);

$insertedId = $db->insert(1, "Hero", 100, 50, 30, true);
if ($insertedId !== null) {
    echo "Personnage inséré avec l'ID : " . $insertedId;
} else {
    echo "Échec de l'insertion.";
}

?>

<!-- <a href="https://pokemondb.net/pokedex/charizard"><img src="https://img.pokemondb.net/sprites/black-white/normal/charizard.png" alt="Charizard"></a>
 <a href="https://pokemondb.net/pokedex/mewtwo"><img src="https://img.pokemondb.net/sprites/black-white/normal/mewtwo.png" alt="Mewtwo"></a>
<a href="https://pokemondb.net/pokedex/blastoise"><img src="https://img.pokemondb.net/sprites/black-white/normal/blastoise.png" alt="Blastoise"></a> -->