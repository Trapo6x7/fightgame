<?php

final class Monster extends Character
{
    private int $ferocity;

    public function __construct(int $id, string $name, int $attack, int $defense, string $imageUrl, int $ferocity, int $pv = 100, bool $isAlive = true)
    {
        parent::__construct($id, $name, $attack, $defense, $imageUrl, $ferocity, $pv, $isAlive);
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
