<?php

final class Hero extends Character
{
    private string $specialSkill;

    public function __construct(int $id, string $name, int $attack, int $defense, string $imageUrl, string $specialSkill, int $pv = 100, bool $isAlive = true)
    {
        parent::__construct($id, $name, $attack, $defense, $imageUrl, $pv, $isAlive);
        $this->specialSkill = $specialSkill;
    }

    public function getSpecialSkill(): string
    {
        return $this->specialSkill;
    }
}