<?php
include_once "../utils/autoloader.php";
require_once './asset/partials/header.php';
session_start();
$heroRepo = new HeroRepository;
$monsterRepo = new MonsterRepository;
$fightManager = new FightsManager;
$monsterMapper = new MonsterMapper;
$hero = $_SESSION['hero'];
var_dump($hero);
$hero->useSpecialSkill();
var_dump($hero);

echo $fightManager->startFight($hero, $monsterRepo->findById(1));