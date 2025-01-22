<?php
require_once "../utils/autoloader.php";
require_once './asset/partials/header.php';

session_start();


if (!isset($_SESSION['hero'])) {
    header("Location: ./home.php");
    exit;
}

/**
 * @var Hero $hero
 */
$hero = $_SESSION['hero'];

$partner = $hero->getPartner();
$skills = $partner->getSkills();

$monsterRepository = new MonsterRepository;

$monster = $monsterRepository->findById(1);

$skillRepository = new SkillRepository();
$skillsMonster = $skillRepository->findByMonsterId(1);
$monster->setSkills($skillsMonster);

$_SESSION['monster'] = $monster;

?>

<div class="combat-layer">
    <div class="combat-header">
        <h1>Combat en cours</h1>
        <p><?= $hero->getName() ?> / Niveau <?= $partner->getLevel() ?></p>
    </div>
    <div class="combat-area">
        <div class="player-info">
            <img src="<?= $partner->getImageUrl() ?>" alt="" class="imgpoke">
            <div>
                <p><span id="partner-name"><?= $partner->getName() ?></span></p>
                <p>PV : <span id="partner-hp"><?= $partner->getPv() ?></span></p>
                <div class="barrePv">
                    <div id="barrePvPartner" style="width: <?= htmlspecialchars($partner->getPv() / $partner->getPv() * 100); ?>%"></div>
                </div>
            </div>

        </div>
        <div class="enemy-info">
            <img src="<?= $monster->getImageUrl() ?>" alt="" class="imgpoke">
            <div>
                <p><span id="monster-name"><?= $monster->getName() ?></span></p>
                <p>PV : <span id="monster-hp"><?= $monster->getPv() ?></span></p>
                <div class="barrePv">
                    <div id="barrePvMonster" style="width: <?= htmlspecialchars($monster->getPv() / $monster->getPv() * 100); ?>%"></div>
                </div>
            </div>

        </div>
    </div>
    <div class="combat-actions">
        <?php
        /**
         * @var Skill $skill
         */
        foreach ($skills as $skill) {
        ?>
            <button class="fetchAttack" data-skill="<?= $skill->getName() ?>">
                <?= $skill->getName() ?>
            </button>
        <?php
        }
        ?>

        <form action="../process/logout.php" method="post">
            <button id=logout> Fuite </button>
        </form>
    </div>
    <div>
        <p id="battleLog"></p>
    </div>
    <?php
    require_once './asset/partials/footer.php';
