<?php

final class Partner extends Pokemon{

    protected int $id;
    protected string $name;
    protected int $pv;
    protected int $attack;
    protected int $defense;
    protected string $imageUrl;
    private int $level;

    public function __construct(int $id, string $name,int $attack, int $defense, string $imageUrl, int $pv = 100,  int $level = 1)
    {
        Parent::__construct($name, $pv, $attack, $defense, $imageUrl);
        $this->level = $level;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName($name) : self
    {
        $this->name = $name;

        return $this;
    }

    public function getPv() : int
    {
        return $this->pv;
    }

    public function setPv($pv) : self
    {
        $this->pv = $pv;

        return $this;
    }

    public function getAttack() : int
    {
        return $this->attack;
    }

    public function setAttack($attack) : self
    {
        $this->attack = $attack;

        return $this;
    }

    public function getDefense() : int
    {
        return $this->defense;
    }

    public function setDefense($defense) : self
    {
        $this->defense = $defense;

        return $this;
    }

    public function setImageUrl($imageUrl) : self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getLevel() : int
    {
        return $this->level;
    }

    public function setLevel($level) : self
    {
        $this->level = $level;

        return $this;
    }
}