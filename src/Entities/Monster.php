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

    public function __construct(int $id, string $name,int $attack, int $defense, string $imageUrl, int $ferocity, int $difficultyLevel, array $skill, int $pv = 100)
    {
        Parent::__construct($id, $name, $pv, $attack, $defense, $imageUrl);
        $this->ferocity = $ferocity;
        $this->difficultyLevel = $difficultyLevel;
        $this->attack = round($attack + round(($ferocity / 8)));
        $this->skills= [];
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
    
    public function getImageUrl() : string
    {
        return $this->imageUrl;
    }
    public function setImageUrl($imageUrl) : self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getFerocity() : int
    {
        return $this->ferocity;
    }

    public function setFerocity($ferocity) : self
    {
        $this->ferocity = $ferocity;

        return $this;
    }

    public function getDifficultyLevel() : int
    {
        return $this->difficultyLevel;
    }


    public function setDifficultyLevel($difficultyLevel) : self
    {
        $this->difficultyLevel = $difficultyLevel;

        return $this;
    }
    
    public function getSkills() : array
    {
        return $this->skills;
    }

    public function setSkills($skills) : self
    {
        $this->skills = $skills;

        return $this;
    }

    public function useRandomSkill(Partner $enemy): void
{
    // Vérifier si le monstre a des compétences
    if (empty($this->getSkills())) {
        echo $this->getName() . " n'a pas de compétences disponibles.\n";
        return;
    }

    // Choisir un skill aléatoire
    $skills = $this->getSkills();
    $randomSkill = $skills[array_rand($skills)];

    // Appliquer l'effet du skill
    $name = $randomSkill->getName();

    if ($name === 'Copie') {
        // Copie l'attaque de l'ennemi avec 20% de réduction
        $copiedAttack = $enemy->getAttack();
        $damage = max(0, $copiedAttack - $this->getDefense());
        $enemy->setPv($enemy->getPv() - $damage);
        echo $this->getName() . " copie l'attaque de " . $enemy->getName() . " avec " . $randomSkill->getName() . " pour " . $damage . " dégâts.\n";
    } elseif ($name === 'Soin') {
        // Soigne le monstre de 20 PV
        $this->setPv($this->getPv() + 20);
        echo $this->getName() . " utilise " . $randomSkill->getName() . " pour se soigner de 20 PV.\n";
    } else {
        // Compétence d'attaque classique
        $damage = max(0, $randomSkill->getAttack() - $enemy->getDefense());
        $enemy->setPv($enemy->getPv() - $damage);
        echo $this->getName() . " attaque " . $enemy->getName() . " avec " . $randomSkill->getName() . " pour " . $damage . " dégâts.\n";
    }
}

}

