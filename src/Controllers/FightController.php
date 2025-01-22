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
        // Vérifie si le monstre est vaincu et effectue une montée en niveau
        if ($this->monster->getPv() <= 0) {
            $this->levelUpHero();  // Montée en niveau du héros
            $this->loadNextMonster();  // Charger le prochain monstre
        }
        // Renvoie les nouvelles données en JSON
        header('Content-Type: application/json');
        echo json_encode([
            'message' => "{$this->hero->getPartner()->getName()} utilise {$action}",
            'partnerHp' => $this->hero->getPartner()->getPv(),
            'monsterHp' => $this->monster->getPv(),
            'battleLogs' => $battleLogs, // Ajout des logs
        ]);
    }

    private function levelUpHero()
    {
        $this->hero->getPartner()->setLevel($this->hero->getPartner()->getLevel() + 1);
        $this->hero->getPartner()->setAttack($this->hero->getPartner()->getAttack() + 10);
        $this->hero->getPartner()->setDefense($this->hero->getPartner()->getDefense() + 10);
    }

    private function loadNextMonster()
    {
        // Charger le prochain monstre (à adapter à ton système)
        $nextMonsterId = $this->monster->getId() + 1;
        $nextMonster = $this->monsterRepo->findById($nextMonsterId);

        if ($nextMonster) {
            $this->monster = $nextMonster;
            $_SESSION['monster'] = $nextMonster;
        } else {
            $_SESSION['monster'] = null;
        }
    }
}
