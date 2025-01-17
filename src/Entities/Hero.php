<?php

class Hero extends Character
{
    private string $specialSkill;

    public function __construct(string $name, string $specialSkill, int $pv = 100, int $attack = 50, int $defense = 20, string $imageUrl = "https://i.pinimg.com/736x/74/aa/81/74aa81e3a2526bdbce75fdacfba7a043.jpg",  bool $isAlive = true)
    {
        // Appel du constructeur parent avec les arguments appropriés
        parent::__construct($name, $pv,  $attack, $defense, $imageUrl, $isAlive, $specialSkill);
        $this->specialSkill = $specialSkill; // Initialisation du skill spécial
    }

    public function getSpecialSkill(): string
    {
        return $this->specialSkill;
    }

    public function useSpecialSkill(): void
    {
        if ($this->specialSkill === "buff_attack") {
            if ($this->attack < 65) {
                $this->attack = $this->attack + $this->attack * 0.3;
            }
        } else if ($this->specialSkill === "heal") {
            if ($this->pv < 100) {
                $this->pv += 30;
            }
        }
    }
}
