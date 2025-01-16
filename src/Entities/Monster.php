<?php

final class Monster extends Character
{
    
    public function __construct(int $id, string $name, int $attack, int $defense, int $pv = 100)
    {
        parent::__construct($id, $name, $attack, $defense, $pv);
    }

    public function attack(Hero $hero): void
    {
        if ($hero->getDefense() >= $this->attack){
            $hero->getPv();
        } else {
            $hero->setPv(($hero->getPv()-$this->attack) + $hero->getDefense());
        }
    }

}
