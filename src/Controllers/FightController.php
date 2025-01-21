<?php

final class FightController
{
    private Hero $hero;
    private Monster $monster;
    private SkillRepository $skillRepo;
    private FightsManager $fightManager;

    public function __construct(Hero $hero, Monster $monster)
    {
        $this->hero = $hero;
        $this->monster = $monster;
        $this->skillRepo = new SkillRepository();
        $this->fightManager = new FightsManager();
    }


    public function handleRequest(array $input)
    {

        $action = $input['action'];
        $skillId = $this->skillRepo->findByName($action)->getId();

        // ajouter fightManager
        $this->fightManager->useSkill($skillId, $this->hero->getPartner(), $this->monster);
        $this->fightManager->useSkill($skillId, $this->monster, $this->hero->getPartner());


        // Renvoie les nouvelles données
        header('Content-Type: application/json');
        echo json_encode([
            'message' => "{$this->hero->getPartner()->getName()} utilise {$action}",
            'partnerHp' => "{$this->hero->getPartner()->getPv()}",
            'monsterHp' => "{$this->monster->getPv()}",
        ]);
    }
}
