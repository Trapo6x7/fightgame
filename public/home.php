<?php
include_once "../utils/autoloader.php";

require_once './asset/partials/header.php';
$heroRepo = new HeroRepository;
$monsterRepo = new MonsterRepository;
$fightManager = new FightsManager;

?>
<main>
    <section>
        <form action="../src/process/add_hero.php" method="POST" class="card">
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
</main>


<?php
require_once './asset/partials/footer.php'
?>