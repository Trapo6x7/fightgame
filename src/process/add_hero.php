<?php
session_start();

require_once '../../utils/autoloader.php'; // Inclure ton autoloader

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère les données du formulaire
    $name = htmlspecialchars(trim($_POST['name'])); // Sécurisation des entrées
    $partnerId = intval($_POST['partnerId']); // Convertit en entier

    try {
        // Initialise le repository des héros
        $heroRepository = new HeroRepository();

        // Crée un nouveau héros avec le partenaire sélectionné
        $heroId = $heroRepository->insert($name, $partnerId);

        if ($heroId) {
            // Stocke les informations dans la session
            $_SESSION['hero_name'] = $name;
            $_SESSION['partner_id'] = $partnerId;

            // Redirection vers la page de combat
            header("Location: ../../public/fight.php?id=" . $heroId);
            exit;
        } else {
            echo "Erreur lors de la création du héros.";
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue : " . $e->getMessage();
    }
} else {
    echo "Aucune donnée reçue.";
}
