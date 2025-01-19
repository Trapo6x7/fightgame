<?php

class SkillMapper implements MapperInterface
{
    public static function mapToObject(array $data): Skill
    {
        return new Skill(
            $data['id'],
            $data['name'],
            $data['attack'],
            $data['effect'] 
        );
    }
}
