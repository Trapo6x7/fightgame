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
        echo "<br> Le combat commence entre {$partner->getName()} et {$monster->getName()} ! ";

        while ($partner->getPv() > 0 && $monster->getPv() > 0) {
            // Tour du héros
            $this->executeTurn($partner, $monster);
            if ($monster->getPv() === 0) {
                echo "<br> {$partner->getName()} a gagné !\n";
                break;
            }

            // Tour du monstre
            $this->executeTurn($monster, $partner);
            if ($partner->getPv() === 0) {
                echo "<br> {$monster->getName()} a gagné !\n";
                break;
            }
        }
    }

    // Exécution d'un tour de combat
    private function executeTurn(Pokemon $attacker, Pokemon $defender): void
    {
        $damage = max(0, $attacker->getAttack() - (round($defender->getDefense() * 0.5)));
   
        $defender->takeDamage($damage);
  
        if (round($defender->getDefense() * 0.3) < $attacker->getAttack()) {
            echo "<br> {$attacker->getName()} attaque {$defender->getName()} et inflige $damage dégâts!\n";
            echo "<br> {$defender->getName()} a maintenant {$defender->getPv()} PV.\n";
        } else {
            echo "<br> {$attacker->getName()} attaque {$defender->getName()} mais rien ne se passe!\n";
        }
    }
}