<?php


class MonsterMapper implements MapperInterface
{
    public static function mapToObject(array $data): Monster
    {
        return new Monster(
            $data['id'],
            $data['name'],
            $data['attack'],
            $data['defense'],
            $data['type'],
            $data['pv'],
            $data['is_alive'],
        );
    }
}
