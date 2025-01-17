<?php

class Monster extends Character {
    private int $ferocity;

    public function __construct(string $name, int $pv, int $attack, int $defense, string $imageUrl, int $ferocity, bool $isAlive = true)
    {
        // Appel du constructeur parent avec les arguments appropriés
        parent::__construct($name, $pv ,$attack, $defense, $imageUrl, $isAlive);
        $this->ferocity = $ferocity;
    }

    public function getFerocity(): int
    {
        return $this->ferocity;
    }

    public function calculateDamage(): int
    {
        $baseDamage = $this->attack;
        $damageBonus = $this->ferocity * 0.2; // Bonus de 20% de l'attaque en fonction de la ferocity
        return (int) ($baseDamage + $damageBonus);
    }
}
