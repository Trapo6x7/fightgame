<?php

abstract class Character {

    protected int $id;
    protected string $name;
    protected int $pv;
    protected int $attack;
    protected int $defense;

    public function __construct(int $id, string $name, int $attack, int $defense, int $pv = 100)
    {
        $this->id = $id;
        $this->name = $name;
        $this->pv = $pv;
        $this->attack = $attack;
        $this->defense = $defense;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPv(): int

    {
        return $this->pv;
    }

    public function setPv($pv): self
    {
        $this->pv = $pv;

        return $this;
    }

    public function getAttack(): int
    {
        return $this->attack;
    }

    public function getDefense(): int
    {
        return $this->defense;
    }

}