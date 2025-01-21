<?php

class SkillMapper implements MapperContract
{
    
    public static function mapToObject(array $data): Skill
    {
        if (!isset($data['id'], $data['name'], $data['attack'])) {
            throw new InvalidArgumentException("Invalid data for mapping to Skill object.");
        };
        
        return new Skill(
            (int) $data['id'],           // Utilise la clé associée 'id'
            $data['name'],               // Utilise la clé associée 'name'
            (int) $data['attack'],       // Utilise la clé associée 'attack'
            $data['effect'] ?? null      // Utilise la clé associée 'effect', ou null par défaut
        );
    }
}
