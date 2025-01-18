<?php
session_start();
require_once '../../utils/autoloader.php'; // Inclure ton autoloader

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère les données du formulaire
    $name = htmlspecialchars($_POST['name']); // Sécurisation des entrées
    $partnerId = intval($_POST['partnerId']); // Convertit en entier

    try {
        // Initialise le repository des héros
        $heroRepository = new HeroRepository();

        // Crée un nouveau héros avec le partenaire sélectionné
        $heroId = $heroRepository->insert($name, $partnerId);

        if ($heroId) {
            echo "Héros créé avec succès ! ID : " . $heroId;
            // Redirection ou affichage d'un message
        } else {
            echo "Erreur lors de la création du héros.";
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue : " . $e->getMessage();
    }
} else {
    echo "Aucune donnée reçue.";
}
header("Location: ../../public/fight.php");