<?php

final class Skill
{
    private int $id;
    private string $name;
    private int $attack;
    private ?string $effect;

    public function __construct(int $id, string $name, int $attack, ?string $effect = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->attack = $attack;
        $this->effect = $effect ?? null;
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

    public function getAttack() : int
    {
        return $this->attack;
    }

    public function setAttack($attack) : self
    {
        $this->attack = $attack;

        return $this;
    }

    public function getEffect() : string
    {
        return $this->effect;
    }

    public function setEffect($effect) : self
    {
        $this->effect = $effect;

        return $this;
    }
}
