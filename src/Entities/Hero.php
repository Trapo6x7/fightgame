<?php

final class Hero extends Character
{
 
    public function __construct(int $id, string $name, int $attack, int $defense, int $pv = 100)
    {
        parent::__construct($id, $name, $attack, $defense, $pv);
    }

    public function attack(Monster $monster): void
    {
        if ($monster->getDefense() >= $this->attack){
            $monster->getPv();
        } else {
            $monster->setPv(($monster->getPv()-$this->attack) + $monster->getDefense());
        }
    }

  
}
