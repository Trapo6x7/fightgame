<?php
include '../utils/autoloader.php';

$rawPostData = file_get_contents('php://input');
$postData = json_decode($rawPostData, true);
$action = $postData['action'];

$validator = new ValidatorService();

$validator->checkMethods('POST');

session_start();
/**
 * @var Hero $hero
 */
$hero = $_SESSION['hero'];

/**
 * @var Monster $monster
 */
$monster = $_SESSION['monster'];

$fightController = new FightController($hero, $monster);
$fightController->handleRequest($postData);
