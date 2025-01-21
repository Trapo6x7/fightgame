<?php

class Partner extends Pokemon
{
    // private int $id;
    // private string $name;
    // private int $pv;
    // private int $attack;
    // private int $defense;
    // private string $imageUrl;
    private int $level;
    private array $skills; // S'assurer que c'est bien un tableau

    public function __construct(int $id, string $name, int $attack, int $defense, string $imageUrl, array $skills, int $pv = 100, int $level = 1)
    {
        Parent::__construct($id, $name, $pv, $attack, $defense, $imageUrl);
        $this->skills = $skills; // Assigner les compétences
        $this->level = $level;
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

    /**
     * Get the value of imageUrl
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }
    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

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

    public function attackEnemy(Monster $enemy, Skill $skill): void
    {
        // Vérifie l'effet de la compétence
        $name = $skill->getName();
        
        if ($name === 'copie') {
            // Copie l'attaque de l'ennemi avec 20% de réduction
            $copiedAttack = $enemy->getAttack() * 0.8; // Réduit l'attaque de 20%
            $damage = max(0, $copiedAttack - $this->getDefense()); // Applique la défense du partenaire
            $enemy->setPv($enemy->getPv() - $damage);
            echo $this->getName() . " copie l'attaque de " . $enemy->getName() . " avec " . $skill->getName() . " pour " . $damage . " dégâts.\n";
        } elseif ($name === 'soin') {
            // Soigne le partenaire de 20 PV
            $this->setPv($this->getPv() + 20);
            echo $this->getName() . " utilise " . $skill->getName() . " pour se soigner de 20 PV.\n";
        } else {
            // Si l'effet est autre (attaque directe par exemple)
            $damage = max(0, $skill->getAttack() - $enemy->getDefense()); // Applique la défense de l'ennemi
            $enemy->setPv($enemy->getPv() - $damage);
            echo $this->getName() . " attaque " . $enemy->getName() . " avec " . $skill->getName() . " pour " . $damage . " dégâts.\n";
        }
    }
}
