<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $roleUser = new Role();
        $roleUser->setNameRole('ROLE_USER');
        $manager->persist($roleUser);

        $roleAdmin = new Role();
        $roleAdmin->setNameRole('ROLE_ADMIN');
        $manager->persist($roleAdmin);

        // Ajoute d'autres rôles si besoin

        $manager->flush();
        echo "Rôles insérés avec succès !\n";
    }
}
