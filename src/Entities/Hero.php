<?php

final class Hero
 {
    private int $id;
    private string $name;
    private Partner $partner;
    private bool $isAlive;

    public function __construct(int $id, string $name, Partner $partner, bool $isAlive = true)
    {
        $this->id = $id;
        $this->name = $name;
        $this->partner = $partner;
        $this->isAlive = $isAlive;

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

    public function getPartner() : Partner
    {
        return $this->partner;
    }

    public function setPartner($partner) : self
    {
        $this->partner = $partner;

        return $this;
    }

    public function getIsAlive() : bool
    {
        return $this->isAlive;
    }

    public function setIsAlive($isAlive) : self
    {
        $this->isAlive = $isAlive;

        return $this;
    }
}