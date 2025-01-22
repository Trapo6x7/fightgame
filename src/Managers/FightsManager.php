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

    public function useSkill(int $skillId, Pokemon $attacker, Pokemon $defender)
    {
        $skillRepo = new SkillRepository;
        $skill = $skillRepo->findById($skillId);

        if ($attacker instanceof Partner && $defender instanceof Monster) {

            if ($skillId === 8) {
                // Copie l'attaque de l'ennemi avec 20% de réduction
                $copiedAttack = $defender->getAttack() * 0.8;
                $damage = max(0, $copiedAttack - $defender->getDefense());
                $defender->setPv(max(0, $defender->getPv() - $damage));
            } elseif ($skillId === 5) {
                // Soigne le partenaire de 20 PV
                $attacker->setPv(min(100, $attacker->getPv() + 20));
            } else {
                $damage = max(0,$attacker->getAttack() + ($skill->getAttack() / 2) - $defender->getDefense()); // Applique la défense de l'ennemi
                $defender->setPv(max(0, $defender->getPv() - $damage));
            }
            
        } else if ($attacker instanceof Monster && $defender instanceof Partner) {
            $attacker->useRandomSkill($defender);
        }
    }

    public function displayBattleLog(int $skillId, Pokemon $attacker, Pokemon $defender): string
    {
        $skillRepo = new SkillRepository;
        $skill = $skillRepo->findById($skillId);

        if ($skillId === 8) {
            return $attacker->getName() . " copie l'attaque de " . $defender->getName() . " avec " . $skill->getName() . "\n";
        } elseif ($skillId === 5) {
            if ($attacker->getPv() >=  100) {
                return $attacker->getName() . " utilise " . $skill->getName() . " mais rien ne se passe\n";
            }
            return $attacker->getName() . " utilise " . $skill->getName() . " pour se soigner de 20 PV.\n";
        } else {
            return $attacker->getName() . " attaque " . $defender->getName() . " avec " . $skill->getName() . "\n";
        }
    }
}
