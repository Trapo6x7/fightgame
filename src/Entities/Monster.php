<?php

final class Monster extends Pokemon
{

    // protected int $id;
    // protected string $name;
    // protected int $pv;
    protected int $attack;
    // protected int $defense;
    // protected string $imageUrl;
    private int $ferocity;
    private int $difficultyLevel;
    private array $skills;

    public function __construct(int $id, string $name, int $attack, int $defense, string $imageUrl, int $ferocity, int $difficultyLevel, array $skill, int $pv = 100)
    {
        Parent::__construct($id, $name, $pv, $attack, $defense, $imageUrl);
        $this->ferocity = $ferocity;
        $this->difficultyLevel = $difficultyLevel;
        $this->attack = round($attack + round(($ferocity / 8)));
        $this->skills = [];
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

    public function setAttack($attack): self
    {
        $this->attack = $attack;

        return $this;
    }

    public function getDefense(): int
    {
        return $this->defense;
    }

    public function setDefense($defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }
    public function setImageUrl($imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getFerocity(): int
    {
        return $this->ferocity;
    }

    public function setFerocity($ferocity): self
    {
        $this->ferocity = $ferocity;

        return $this;
    }

    public function getDifficultyLevel(): int
    {
        return $this->difficultyLevel;
    }


    public function setDifficultyLevel($difficultyLevel): self
    {
        $this->difficultyLevel = $difficultyLevel;

        return $this;
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function setSkills($skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function useRandomSkill(Partner $enemy): int
{
    // Choisir un skill aléatoire
    $skills = $this->getSkills();

    if (empty($skills)) {
        throw new Exception("Le monstre n'a pas de compétences.");
    }

    $randomSkill = $skills[array_rand($skills)];

    // Appliquer l'effet du skill
    $skillId = $randomSkill->getId();

    if ($skillId === 8) {
        // Copie l'attaque de l'ennemi avec 20% de réduction
        $copiedAttack = $enemy->getAttack();
        $damage = max(0, $copiedAttack - $this->getDefense());
        $enemy->setPv($enemy->getPv() - $damage);
        return $skillId;
    } elseif ($skillId === 5) {
        // Soigne le monstre de 20 PV
        $this->setPv($this->getPv() + 20);
        return $skillId;
    } else {
        $damage = max(0, $randomSkill->getAttack() - $enemy->getDefense());
        $enemy->setPv($enemy->getPv() - $damage);
        return $skillId;
    }
}
}
