<?php

final class Monster extends Character
{

    public function __construct(int $id, string $name, int $attack, int $defense, int $pv = 100, bool $isAlive = true)
    {
        parent::__construct($id, $name, $attack, $defense, $pv, $isAlive);
    }
    
    public function roar(): string
    {
        return "{$this->getName()} rugit férocement !";
    }

}
