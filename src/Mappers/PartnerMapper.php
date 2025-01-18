<?php


class PartnerMapper implements MapperInterface
{
    public static function mapToObject(array $data): Partner
    {
        // var_dump($data);
        // die();
        return new Partner(
            $data['id'],          // ID
            $data['name'],        // Nom
            $data['attack'],      // Attaque
            $data['defense'],     // Défense
            $data['image_url'],   // URL de l'image
            $data['pv'],          // Points de vie
            $data['level']        // Niveau
        );
    }
}
