<?php
session_start();
include_once "../utils/autoloader.php";
require_once './asset/partials/header.php';
?>
    <div class="combat-layer">
        <div class="combat-header">
            <h1>Combat en cours</h1>
        </div>
        <div class="combat-area">
            <div class="player-info">
                <p>Héros : <span id="player-name">Green</span></p>
                <p>PV : <span id="player-hp">100</span></p>
            </div>
            <div class="enemy-info">
                <p>Ennemi : <span id="enemy-name">Dracaufeu</span></p>
                <p>PV : <span id="enemy-hp">120</span></p>
            </div>
        </div>
        <div class="combat-actions">
            <button id="attack-btn">Attaquer</button>
            <button id="defend-btn">Défendre</button>
            <button id="special-btn">Spécial</button>
        </div>
<?php 
require_once './asset/partials/footer.php';