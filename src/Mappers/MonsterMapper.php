<?php


class MonsterMapper implements MapperInterface
{
    public static function mapToObject(array $data): Monster
    {
        // var_dump($data);
        // die();
        return new Monster(
            $data['id'],          // ID
            $data['name'],        // Nom
            $data['attack'],      // Attaque
            $data['defense'],     // Défense
            $data['image_url'],   // URL de l'image
            $data['ferocity']  ,      // Niveau
            $data['difficulty_level'],
            $data['pv'],          // Points de vie
        );
    }
}
