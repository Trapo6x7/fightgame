<?php
include_once "../utils/autoloader.php";


class FightsManager
{

    private PartnerRepository $partnerRepository;
    private MonsterRepository $monsterRepository;

    public function __construct()
    {
        $this->partnerRepository = new PartnerRepository;
        $this->monsterRepository = new MonsterRepository;
    }



    public function startFight(Partner $partner, Monster $monster): void
    {

        echo "<br> Le combat commence entre {$partner->getName()} et {$monster->getName()} !";

        while ($partner->getPv() > 0 && $monster->getPv() > 0) {
            // Tour du joueur
            echo "\n--- Tour du joueur ---\n";
            $this->executeTurn($partner, $monster);

            if ($monster->getPv() <= 0) {
                echo "<br> {$monster->getName()} est K.O. ! {$partner->getName()} remporte le combat !\n";
                $partner->getLevel() + 1;
                ($partner->getAttack() + 10) * $monster->getDifficultyLevel();
                ($partner->getDefense() + 10) * $monster->getDifficultyLevel();;
                $this->monsterRepository->findById($monster->getId() + 1);
                break;
            }

            // Tour du monstre
            echo "\n--- Tour du monstre ---\n";
            $this->executeTurn($monster, $partner);

            if ($partner->getPv() <= 0) {
                echo "<br> {$partner->getName()} est K.O. ! {$monster->getName()} remporte le combat !\n";
                break;
            }
        }
    }

    private function executeTurn(Pokemon $attacker, Pokemon $defender): void
    {
        if ($attacker instanceof Partner) {
            // Si c'est le joueur, on utilise le premier skill (par exemple).
            $skill = $attacker->getSkills()[0]; // Remplace 0 par un choix dynamique si besoin.
            $damage = max(0, $skill->getAttack() - round($defender->getDefense() * 0.5));

            $defender->takeDamage($damage);

            echo "<br> {$attacker->getName()} utilise {$skill->getName()} et inflige $damage dégâts à {$defender->getName()} !\n";
            echo "<br> {$defender->getName()} a maintenant {$defender->getPv()} PV.\n";
        } elseif ($attacker instanceof Monster) {
            // Si c'est un monstre, il utilise une compétence aléatoire.
            $attacker->useRandomSkill($defender);
        }
    }

    public function useSkill(int $skillId, Pokemon $attacker, Pokemon $defender)
    {
        $skillRepo = new SkillRepository;
        $skill = $skillRepo->findById($skillId);

        if ($attacker instanceof Partner) {

        if ($skillId === 8) {
            // Copie l'attaque de l'ennemi avec 20% de réduction
            $copiedAttack = $defender->getAttack() * 0.8;
            $damage = max(0, $copiedAttack - $defender->getDefense());
            $defender->setPv($defender->getPv() - $damage);
            // echo $attacker->getName() . " copie l'attaque de " . $defender->getName() . " avec " . $skill->getName() . " pour " . $damage . " dégâts.\n";
        } elseif ($skillId === 5) {
            // Soigne le partenaire de 20 PV
            $attacker->setPv($attacker->getPv() + 20);
            // echo $attacker->getName() . " utilise " . $skill->getName() . " pour se soigner de 20 PV.\n";
        } else {
            // Si l'effet est autre (attaque directe par exemple)
            $damage = max(0, $skill->getAttack() - $defender->getDefense()); // Applique la défense de l'ennemi
            $defender->setPv($defender->getPv() - $damage);
            // echo $attacker->getName() . " attaque " . $defender->getName() . " avec " . $skill->getName() . " pour " . $damage . " dégâts.\n";
        }
    }
       else if ($attacker instanceof Monster) {
            // Si c'est un monstre, il utilise une compétence aléatoire.
            $attacker->useRandomSkill($defender);
        }
    }
}
