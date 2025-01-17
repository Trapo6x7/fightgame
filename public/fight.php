<?php
include_once "../utils/autoloader.php";

require_once './asset/partials/header.php';
$heroRepo = new HeroRepository;
$monsterRepo = new MonsterRepository;
$fightManager = new FightsManager;

var_dump($monsterRepo->findAll());

// $monster = new Monster(1, "karlito", 10, 3);
$monsterKaaris = $monsterRepo->findById(3);
var_dump($monsterKaaris);
// var_dump($monsterKaaris);
// var_dump($_GET['id']);
// var_dump($heroRepo->findById(intval($_GET['id'])));

// $fightManager->startFight(($heroRepo->findById(intval($_GET['id']))), $monster);

// $monsterRepo->insert(3, "Kaaris", 60, 30, "https://diffusionph.cccommunication.biz/jpgok/RepGR/747/747512_2.jpg", "monster");




