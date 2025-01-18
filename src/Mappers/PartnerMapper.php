<?php


class PartnerMapper implements MapperInterface
{
    public static function mapToObject(array $data): Hero
    {
        // var_dump($data);
        return new Hero(
            $data['id'],
            $data['name'],
            $data['pv'],
            $data['attack'],
            $data['defense'],
            $data['imageUrl'],
            $data['level']
        );
    }
}
