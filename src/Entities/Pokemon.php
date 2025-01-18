<?php

abstract class Pokemon {
    protected int $id;
    protected string $name;
    protected int $pv;
    protected int $attack;
    protected int $defense;
    protected string $imageUrl;

    public function __construct(int $id,string $name,int $pv, int $attack, int $defense, string $imageUrl)
    {
        $this->id=$id;
        $this->name = $name;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->imageUrl = $imageUrl;
        $this->pv = max(0, $pv);
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;

        return $this;
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


    public function takeDamage(int $damage): void
    {
        $this->pv = max(0, $this->pv - $damage);
    }

    /**
     * Get the value of imageUrl
     */ 
    public function getImageUrl()
    {
        return $this->imageUrl;
    }


}