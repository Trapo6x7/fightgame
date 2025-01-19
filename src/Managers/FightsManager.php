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
    
    /**
     * Exécution d'un tour d'attaque entre un attaquant et un défenseur.
     */
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
    
}