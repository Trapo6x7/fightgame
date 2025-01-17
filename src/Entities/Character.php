<?php

abstract class Character {

    protected int $id;
    protected string $name;
    protected int $pv;
    protected int $attack;
    protected int $defense;
    protected bool $isAlive;
    protected string $imageUrl;


    public function __construct(int $id, string $name, int $attack, int $defense, string $imageUrl, int $pv = 100, bool $isAlive = true)
    {
        $this->id = $id;
        $this->name = $name;
        $this->pv = $pv;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->isAlive =$this->pv > 0;
        $this->imageUrl = $imageUrl;
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

    public function setPv(int $pv): self
    {
        $this->pv = max(0, $pv);
        $this->isAlive = $this->pv > 0;
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

    public function getIsAlive()
    {
        return $this->isAlive;
    }

    public function takeDamage(int $damage): void
    {
        $damageTaken = max(0, $damage - $this->defense);
        $this->setPv($this->pv - $damageTaken);
    }

    public function heal(int $amount): void
    {
        if ($this->isAlive) {
            $this->setPv($this->pv + $amount);
        }
    }

    /**
     * Get the value of imageUrl
     */ 
    public function getImageUrl()
    {
        return $this->imageUrl;
    }
}