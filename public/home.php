<?php

include_once "../utils/autoloader.php";

$fightManager= new FightsManager;

$hero = new Hero(1, "trapo", 35, 25);

var_dump($hero);

$monster = new Monster(1, "karlito", 10, 3);

var_dump($monster);

$fightManager->startFight($hero, $monster);

var_dump($hero);
var_dump($monster);
