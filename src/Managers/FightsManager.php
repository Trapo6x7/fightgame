<?php
include_once "../utils/autoloader.php";


class FightsManager
{
    // Méthode principale pour lancer un combat
    public function startFight(Hero $hero, Monster $monster): void
    {
        echo "Le combat commence entre {$hero->getName()} et {$monster->getName()} !\n";

        while ($hero->getIsAlive() && $monster->getIsAlive()) {
            // Tour du héros
            $this->executeTurn($hero, $monster);
            if (!$monster->getIsAlive()) {
                echo "{$hero->getName()} a gagné !\n";
                break;
            }

            // Tour du monstre
            $this->executeTurn($monster, $hero);
            if (!$hero->getIsAlive()) {
                echo "{$monster->getName()} a gagné !\n";
                break;
            }
        }
    }

    // Exécution d'un tour de combat
    private function executeTurn(Character $attacker, Character $defender): void
    {
        $damage = max(0, $attacker->getAttack() - $defender->getDefense());
        $defender->takeDamage($damage);
        if ($defender->getDefense() < $attacker->getAttack()) {
            echo "{$attacker->getName()} attaque {$defender->getName()} et inflige $damage dégâts!\n";
            echo "{$defender->getName()} a maintenant {$defender->getPv()} PV.\n";
        } else {
            echo "{$attacker->getName()} attaque {$defender->getName()} mais rien ne se passe!\n";
        }
    }
}
