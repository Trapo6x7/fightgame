<?php


class HeroMapper implements MapperInterface
{
    public static function mapToObject(array $data): Hero
    {
        // var_dump($data);
        return new Hero(
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
