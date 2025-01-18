<?php

include_once "../utils/autoloader.php";

$partnerRepository = new PartnerRepository;
// Vérifie si les données de session existent
if (isset($_SESSION['hero_name']) && isset($_SESSION['partner_id'])) {
    $heroName = $_SESSION['hero_name'];
    $partner = $partnerRepository->findById($_SESSION['partner_id']);
} else {
    // Redirige vers une autre page si les données sont manquantes
    header("Location: ./home.php");
    exit;
}



