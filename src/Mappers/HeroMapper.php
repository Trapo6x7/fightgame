<?php


class HeroMapper implements MapperInterface
{
    public static function mapToObject(array $data): Hero
    {
        return new Hero(
            $data['id'],
            $data['name'],
            $data['pv'],
            $data['attack'],
            $data['defense'],
        );
    }
}
