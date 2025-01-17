<?php


class MonsterMapper implements MapperInterface
{
    public static function mapToObject(array $data): Monster
    {
        return new Monster(
            $data['name'],
            $data['pv'],
            $data['attack'],
            $data['defense'],
            $data['is_alive'],
            $data['ferocity'],
        );
    }
}
