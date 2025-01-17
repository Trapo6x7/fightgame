<?php
include_once "../../utils/autoloader.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $name = $_POST['name'];
    $specialSkill = $_POST['specialSkill'];

    // Créer une instance de Hero avec l'id en paramètre (initialement null)
    $hero = new Hero($name, $specialSkill);

    // Insérer le héros dans la base de données
    $heroRepository = new HeroRepository();
    $heroId = $heroRepository->insert($hero);

    $hero->setId($heroId);

    $_SESSION['hero'] = $hero;

    if ($heroId) {
        // Une fois inséré, on met à jour l'objet Hero avec l'ID généré
        $hero->setId($heroId);
        echo "Le héros a été ajouté avec succès. ID: $heroId";

    } else {
        echo "Une erreur est survenue lors de l'ajout du héros.";
    }

    
    header("Location: ../../public/fight.php");
}
