<?php
$_SESSION = [];


include_once "../utils/autoloader.php";
require_once './asset/partials/header.php';


$parterRepository = new PartnerRepository;
$monsterRepository = new MonsterRepository;

// $partnerRepository = new PartnerRepository();
// $partner = $partnerRepository->findById($partnerId);

// $skillRepository = new SkillRepository();
// $skills = $skillRepository->findByPartnerId($partner->getId());
// $partner->setSkills($skills);


// $dracaufeu = new Partner(1, "Dracaufeu", 30, 20, "./asset/imgs/spritedracaufeu.png");
// $tortank = new Partner(2, "Tortank", 20, 30, "./asset/imgs/spritetortank.png");
// $florizarre = new Partner(3, "Florizarre", 25, 25, "./asset/imgs/spriteflorizarre.png");
// $monsters=[
//     $ditto = new Monster(1, "Metamorph", 15 , 15, "./asset/imgs/spriteditto", 15 , 1),
// $arbok = new Monster(100, "Arbok", 30 , 20, "./asset/imgs/spritearbok", 30 , 2),
// $ectoplasma = new Monster(100, "Ectoplasma", 40, 30, "./asset/imgs/spritegengar", 50 , 3),
// $mewtwo = new Monster(100, "Mewtwo", 50 , 50, "./asset/imgs/spritemewtwo", 75 , 4),
// $missingNo = new Monster(100, "MissingNo", 70 , 60, "./asset/imgs/spriteboss", 100 , 5),
// ];

// $monsterRepository->insert(100, "Metamorph", 15 , 15, "./asset/imgs/spriteditto", 15 , 1);
// $monsterRepository->insert(100, "Arbok", 30 , 20, "./asset/imgs/spritearbok", 30 , 2);
// $monsterRepository->insert(100, "Ectoplasma", 40, 30, "./asset/imgs/spritegengar", 50 , 3);
// $monsterRepository->insert(100, "Mewtwo", 50 , 50, "./asset/imgs/spritemewtwo", 75 , 4);
// $monsterRepository->insert(100, "MissingNo", 70 , 60, "./asset/imgs/spriteboss", 100 , 5);
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
require_once './asset/partials/footer.php'
?>