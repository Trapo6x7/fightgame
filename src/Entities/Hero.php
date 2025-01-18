<?php

final class Hero {
    protected int $id;
    protected string $name;
    protected partner $partner;
    protected bool $isAlive;

    public function __construct(string $name, Partner $partner, bool $isAlive)
    {
        $this->name = $name;
        $this->partner = $partner->getId();
        $this->isAlive = $partner->getPv() > 0;

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