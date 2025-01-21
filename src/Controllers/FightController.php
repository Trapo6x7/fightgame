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


    public function handleRequest(array $postData)
    {
        $action = $postData['action'];

        $skill = $this->skillRepo->findByName($action);

        // ajouter fightManager
        $this->fightManager->useSkill($skill, $this->monster, $this->hero->getPartner());
        $monsterHp = $this->monster->getPv();
        $partnerHp = $this->monster->getPv();

        // Renvoie les nouvelles données
    echo json_encode([
        'message' => "{$this->hero->getPartner()->getName()} utilise {$action}",
        'monsterHp' => $monsterHp,
        'partnerHp' => $partnerHp,
    ]);
    }

}