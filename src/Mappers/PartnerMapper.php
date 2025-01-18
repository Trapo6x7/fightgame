<?php


class PartnerMapper implements MapperInterface
{
   

    public static function mapToObject(array $data): Partner
    {
        $skills = (new SkillRepository())->findByPartnerId($data['id']);

        return new Partner(
            $data['id'],          // ID
            $data['name'],        // Nom
            $data['attack'],      // Attaque
            $data['defense'],     // Défense
            $data['image_url'],   // URL de l'image
            $skills,
            $data['pv'],          // Points de vie
            $data['level'],
        );
    }
}
