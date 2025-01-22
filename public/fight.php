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

$skillRepository = new SkillRepository();

$monsters = [
    $monster1 = $monsterRepository->findById(1),
    $monster2 = $monsterRepository->findById(2),
    $monster3 = $monsterRepository->findById(3),
    $monster4 = $monsterRepository->findById(4),
    $monster5 = $monsterRepository->findById(5),
];


$monstersArray = [$monster1, $monster2, $monster3, $monster4, $monster5];

$monsterIndex = isset($_SESSION['monsterIndex']) ? $_SESSION['monsterIndex'] : 0; // Récupère l'index du monstre actuel depuis la session, sinon démarre à 0

// Charge le monstre actuel en fonction de l'index
$currentMonster = $monstersArray[$monsterIndex];
// Charge les compétences du monstre actuel
$skillsMonster = $skillRepository->findByMonsterId($currentMonster->getId());
$currentMonster->setSkills($skillsMonster);

if ($currentMonster->getPv() <= 0) {
    // Si le monstre est vaincu, on passe au monstre suivant
    $monsterIndex++; // Passe au monstre suivant

    // Si on a dépassé le dernier monstre, le jeu se termine
    if ($monsterIndex >= count($monstersArray)) {
        $_SESSION['monster'] = null;
        echo "Tous les monstres ont été vaincus ! Fin du jeu.";
    } else {
        // Charge le prochain monstre et mets à jour l'index
        $_SESSION['monster'] = $monstersArray[$monsterIndex];
        $_SESSION['monsterIndex'] = $monsterIndex; // Sauvegarde l'index dans la session
    }
} else {
    // Sinon, garde le monstre actuel
    $_SESSION['monster'] = $currentMonster;

}

?>

<div class="combat-layer">
    <div class="combat-header">
        <h1>Combat en cours</h1>
        <p ><?= $hero->getName() ?> / Niveau <span id="combat-header"><?= $partner->getLevel() ?></span></p>
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
            <img src="<?= $currentMonster->getImageUrl() ?>" alt="" class="imgpoke">
            <div>
                <p><span id="monster-name"><?= $currentMonster->getName() ?></span></p>
                <p>PV : <span id="monster-hp"><?= $currentMonster->getPv() ?></span></p>
                <div class="barrePv">
                    <div id="barrePvMonster" style="width: <?= htmlspecialchars($currentMonster->getPv() / $currentMonster->getPv() * 100); ?>%"></div>
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
