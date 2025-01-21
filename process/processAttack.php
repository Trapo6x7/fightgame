<?php

include '../utils/autoloader.php';

$rawPostData = file_get_contents('php://input');
$postData = json_decode($rawPostData, true);


// echo json_encode([
//     'message' => $postData['action'],
// ]);
// exit;

$validator = new ValidatorService();

$validator->checkMethods('POST');

// Ajouter des stratégies de validation
// $validator->addStrategy('name', new RequiredValidator()); // Le nom ne doit pas être vide
// $validator->addStrategy('name', new StringValidator(30)); // Le nom ne doit pas être vide
// $validator->addStrategy('partnerId', new RequiredValidator()); // Le partnerId doit être un nombre
// $validator->addStrategy('partnerId', new IntegerValidator()); // Le partnerId doit être un nombre


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