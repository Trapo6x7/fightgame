<?php

final class FightController
{
    private Hero $hero;
    private Monster $monster;
    private SkillRepository $skillRepo;
    private MonsterRepository $monsterRepo;
    private FightsManager $fightManager;

    public function __construct(Hero $hero, Monster $monster)
    {
        $this->hero = $hero;
        $this->monster = $monster;
        $this->skillRepo = new SkillRepository();
        $this->monsterRepo = new MonsterRepository();
        $this->fightManager = new FightsManager();
    }


    public function handleRequest(array $input)
    {
        $action = $input['action'];
        $skillId = $this->skillRepo->findByName($action)->getId();

        $battleLogs = [];

        // Utilisation des compétences et ajout des logs
        $battleLogs[] = $this->fightManager->displayBattleLog($skillId, $this->hero->getPartner(), $this->monster);
        $this->fightManager->useSkill($skillId, $this->hero->getPartner(), $this->monster);

        $battleLogs[] = $this->fightManager->displayBattleLog(
            $this->monster->useRandomSkill($this->hero->getPartner()),
            $this->monster,
            $this->hero->getPartner()
        );
        $test = $this->hero->getPartner()->getLevel();
        // Vérifie si le monstre est vaincu et effectue une montée en niveau
        if ($this->monster->getPv() <= 0) {
            $this->levelUpHero();  // Montée en niveau du héros
            $test = $this->hero->getPartner()->getLevel();
            $this->loadNextMonster();  // Charger le prochain monstre
        }

        // Récupère les compétences du nouveau monstre
        $monsterSkills = $this->monster->getSkills();
        $monsterSkillsData = [];
        foreach ($monsterSkills as $skill) {
            $monsterSkillsData[] = $skill->getName();
        }

        // Récupère les nouvelles stats du héros après la montée en niveau
        $partner = $this->hero->getPartner();
        $heroStats = [
            'level' => $partner->getLevel(),
            'attack' => $partner->getAttack(),
            'defense' => $partner->getDefense(),
            'hp' => $partner->getPv()
        ];

        // Renvoie les nouvelles données en JSON
        header('Content-Type: application/json');
        echo json_encode([
            'message' => "{$partner->getName()} utilise {$action}",
            'partnerHp' => $partner->getPv(),
            'monsterHp' => $this->monster->getPv(),
            'monsterName' => $this->monster->getName(),
            'monsterImageUrl' => $this->monster->getImageUrl(),
            'battleLogs' => $battleLogs, // Ajout des logs
            'monsterSkills' => $monsterSkillsData, // Ajout des compétences du monstre
            'heroStats' => $heroStats, // Ajout des nouvelles stats du héros
            'test' => $test
        ]);
    }

    private function levelUpHero()
    {
        $partner = $this->hero->getPartner();
        $partner->setLevel($partner->getLevel() + 1);
        $partner->setAttack($partner->getAttack() + 2);
        $partner->setDefense($partner->getDefense() + 2);
    }

    private function loadNextMonster()
    {
        // Charger le prochain monstre (à adapter à ton système)
        $nextMonsterId = $this->monster->getId() + 1;
        $nextMonster = $this->monsterRepo->findById($nextMonsterId);

        if ($nextMonster) {
            $this->monster = $nextMonster;
            $_SESSION['monster'] = $nextMonster;

            // Charger les compétences du nouveau monstre
            $skillsMonster = $this->skillRepo->findByMonsterId($nextMonster->getId());
            $this->monster->setSkills($skillsMonster);
        } else {
            $_SESSION['monster'] = null;
        }
    }
}
