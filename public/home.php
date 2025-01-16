<?php

include_once "../utils/autoloader.php";

$hero = new Hero(1, "trapo", 35, 25);

var_dump($hero);

$monster = new Monster(1, "karlito", 20, 3);

var_dump($monster);

$hero->attack($monster);
var_dump($monster);

$monster->attack($hero);

var_dump($hero);

