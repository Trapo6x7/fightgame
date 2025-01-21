<?php

class DisplayManager
{

    public function displayHome(): string
    {

        ob_start();
?>
        <main>
            <section>
                <form action="../process/add_hero.php" method="POST" class="card">
                    <label for="name">Comment tu t'appelles?</label>
                    <input type="text" id="name" name="name" required><br><br>
                    <label for="partnerId">Choisis ton partenaire:</label>
                    <select id="partnerId" name="partnerId" required>
                        <option value="1">Dracaufeu</option>
                        <option value="2">Tortank</option>
                        <option value="3">Florizarre</option>
                    </select><br><br>
                    <input type="submit" value="START">
                </form>
            </section>
            <section>
                <img src="./asset/imgs/spritehero.png" alt="hero" id="hero">
            </section>
        </main>
    <?php
        return ob_get_clean();
    }

    public function displayFight(): string
    {
        ob_start();
     ?>

     
    <?php
        return ob_end_clean();
    }
}
