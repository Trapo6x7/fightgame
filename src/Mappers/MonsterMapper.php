<?php


class MonsterMapper implements MapperInterface
{
    public static function mapToObject(array $data): Monster
    {
        return new Monster(
            $data['id'],
            $data['name'],
            $data['pv'],
            $data['attack'],
            $data['defense'],
        );
    }
}
