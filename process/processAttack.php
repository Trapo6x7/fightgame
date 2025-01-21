<?php
include '../utils/autoloader.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
