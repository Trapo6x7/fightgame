<?php
include_once "../utils/autoloader.php";

require_once './asset/partials/header.php';
$heroRepo = new HeroRepository;
$monsterRepo = new MonsterRepository;
$fightManager = new FightsManager;

?>

<section>
<form action="../src/process/add_hero.php" method="POST">
    <label for="name">Nom du Héros:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="specialSkill">Compétence Spéciale:</label>
    <select id="specialSkill" name="specialSkill" required>
        <option value="heal">Heal</option>
        <option value="buff_attack">Buff d'attaque</option>
    </select><br><br>

    <input type="submit" value="Ajouter le Héros">
</form>
</section>
<!-- $fightManager->displayHero() -->

<?php
require_once './asset/partials/footer.php'
?>
<!-- <a href="https://pokemondb.net/pokedex/charizard"><img src="https://img.pokemondb.net/sprites/black-white/normal/charizard.png" alt="Charizard"></a>
 <a href="https://pokemondb.net/pokedex/mewtwo"><img src="https://img.pokemondb.net/sprites/black-white/normal/mewtwo.png" alt="Mewtwo"></a>
<a href="https://pokemondb.net/pokedex/blastoise"><img src="https://img.pokemondb.net/sprites/black-white/normal/blastoise.png" alt="Blastoise"></a> -->
