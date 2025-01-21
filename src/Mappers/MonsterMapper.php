<?php


class MonsterMapper implements MapperContract
{
    public static function mapToObject(array $data): Monster
    {
        $skills = (new SkillRepository())->findByMonsterId($data['id']);

        return new Monster(
            $data['id'],          // ID
            $data['name'],        // Nom
            $data['attack'],      // Attaque
            $data['defense'],     // Défense
            $data['image_url'],   // URL de l'image
            $data['ferocity']  ,      // Niveau
            $data['difficulty_level'],
            $skills,   
            $data['pv'],      
        );
    }
}
