<?php
// $_SESSION = [];

include_once "../utils/autoloader.php";
require_once './asset/partials/header.php';

?>
  <button class="playbutton " id="playButton">▶</button>
  <button class="mutebutton" id="muteButton">❚❚</button>
<audio autoplay muted  volume="0.2" id="myAudio">
  <source src="./asset/audio/Intro.mp3" type="audio/mp3">
</audio>
<audio id="beepAudio">
  <source src="./asset/audio/beep.mp3" type="audio/mp3">
</audio>
<main>
    <section>
        <form action="../process/add_hero.php" method="POST" class="card">
            <label for="name">Comment tu t'appelles?</label>
            <input class="beep" type="text" id="name" name="name" required><br><br>
            <label for="partnerId">Choisis ton partenaire:</label>
            <select  class="beep"  id="partnerId" name="partnerId" required>
                <option  class="beep"  value="1">Dracaufeu</option>
                <option  class="beep" value="2">Tortank</option>
                <option  class="beep" value="3">Florizarre</option>
            </select><br><br>
            <input class="beep"  type="submit" value="START">
        </form>
    </section>
    <section>
        <img src="./asset/imgs/spritehero.png" alt="hero" id="hero">
    </section>
</main>

<?php

require_once './asset/partials/footer.php'
?>