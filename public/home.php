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
            <label for="name">Comment tu t'appelles?</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="specialSkill">Choisis ton partenaire:</label>
            <select id="specialSkill" name="specialSkill" required>
                <option value="dracaufeu">Dracaufeu</option>
                <option value="florizarre">Florizarre</option>
                <option value="tortank">Tortank</option>
            </select><br><br>

            <input type="submit" value="START">
        </form>
    </section>
    <section>
        <img src="./asset/imgs/spritehero.png" alt="hero" id="hero">
    </section>
</main>


<?php
require_once './asset/partials/footer.php'
?>