<?php
session_start(); 

include_once "../utils/autoloader.php";
require_once './asset/partials/header.php';
require_once '../process/check_session.php';

$monsterRepository = new MonsterRepository;
$fightManager = new FightsManager;
$monster = $monsterRepository->findById(1);
$skillRepository = new SkillRepository();
$skills = $partner->getSkills();
$skillsMonster = $skillRepository->findByMonsterId(1);
$monster->setSkills($skillsMonster);
?>

<div class="combat-layer">
    <div class="combat-header">
        <h1>Combat en cours</h1>
        <p><?= $heroName ?> / Niveau <?= $partner->getLevel() ?></p>
    </div>
    <div class="combat-area">
        <div class="player-info">
            <img src="<?= $partner->getImageUrl() ?>" alt="" class="imgpoke">
            <div>
                <p><span id="partner-name"><?= $partner->getName() ?></span></p>
                <p>PV : <span id="partner-hp"><?= $partner->getPv() ?></span></p>
            </div>

        </div>
        <div class="enemy-info">
            <img src="<?= $monster->getImageUrl() ?>" alt="" class="imgpoke">
            <div>
                <p><span id="monster-name"><?= $monster->getName() ?></span></p>
                <p>PV : <span id="monster-hp"><?= $monster->getPv() ?></span></p>
            </div>

        </div>
    </div>
    <div class="combat-actions">
            <?php
            foreach ($skills as $skill) {
            ?>
                <button id="attack" class="fetchAttack" data-skill="<?= $skill->getname() ?>">
                    <?= $skill->getname() ?>
                </button>
            <?php
            }
            ?>
    
        <form action="../process/logout.php" method="post">
            <button id=logout> Fuite </button>
        </form>

    </div>
    <?php
    require_once './asset/partials/footer.php';
  