<?php
include_once "../utils/autoloader.php";

require_once './asset/partials/header.php';
$heroRepo = new HeroRepository;
$monsterRepo = new MonsterRepository;
$fightManager = new FightsManager;

$monster = new Monster(1, "karlito", 10, 3);

var_dump($_GET['id']);
var_dump($heroRepo->findById(intval($_GET['id'])));

$fightManager->startFight(($heroRepo->findById(intval($_GET['id']))), $monster);





