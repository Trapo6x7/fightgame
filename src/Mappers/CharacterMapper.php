<?php


class CharacterMapper implements MapperInterface
{
    public static function mapToObject(array $data): Character
    {
        return new Character(
            $data['id'],
            $data['name'],
            $data['pv'],
            $data['attack'],
            $data['defense'],
        );
    }
}
