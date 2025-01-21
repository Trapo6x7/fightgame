<?php
require_once '../utils/autoloader.php'; // Inclure ton autoloader

// Initialiser le service de validation
$validator = new ValidatorService();

$validator->checkMethods('POST');

// Ajouter des stratégies de validation
$validator->addStrategy('name', new RequiredValidator()); // Le nom ne doit pas être vide
$validator->addStrategy('name', new StringValidator(30)); // Le nom ne doit pas être vide
$validator->addStrategy('partnerId', new RequiredValidator()); // Le partnerId doit être un nombre
$validator->addStrategy('partnerId', new IntegerValidator()); // Le partnerId doit être un nombre

if (!$validator->validate($_POST)) {
    header('location: ../public/home.php');
    return;
}
// Récupère et nettoie les données du formulaire
$data = $validator->sanitize($_POST);

session_start();

$partnerRepo = new PartnerRepository();

$partner = $partnerRepo->findById($data['partnerId']);

// Initialise le repository des héros
$heroRepository = new HeroRepository();

$hero = new Hero(0, $data['name'], $partner);

// Crée un nouveau héros avec le partenaire sélectionné
$hero = $heroRepository->insert($hero);

if ($hero) {
    // Stocke les informations dans la session
    $_SESSION['hero'] = $hero;
    // var_dump($_SESSION);
    // die();
    // Redirection vers la page de combat
    header("Location: ../public/fight.php");
    exit;
} else {
    echo "Erreur lors de la création du héros.";
}
