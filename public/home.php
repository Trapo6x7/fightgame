<?php
include_once "../utils/autoloader.php";

require_once './asset/partials/header.php';

$parterRepository = new PartnerRepository;

$dracaufeu = new Partner(1, "Dracaufeu", 30, 20, "./asset/imgs/spritedracaufeu.png");
$tortank = new Partner(2, "Tortank", 20, 30, "./asset/imgs/spritetortank.png");
$florizarre = new Partner(3, "Florizarre", 25, 25, "./asset/imgs/spriteflorizarre.png");

?>

<div>
    
</div>
<main>
    <section>
        <form action="../src/process/add_hero.php" method="POST" class="card">
            <label for="name">Comment tu t'appelles?</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="partnerId">Choisis ton partenaire:</label>
            <select id="partnerId" name="partnerId" required>
                <option value="1">Dracaufeu</option>
                <option value="2">Florizarre</option>
                <option value="3">Tortank</option>
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