<?php


class HeroMapper implements MapperContract
{

    public static function mapToObject(array $data): Hero
    {
     
        return new Hero(
            $data['id'],
            $data['name'],
            $data['partner'],
            $data['is_alive']
        );
    }
}
