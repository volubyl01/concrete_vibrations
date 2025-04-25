<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use App\Entity\Role;
use Doctrine\Persistence\ObjectManager;


// incrémentera dans la tables associative role_user
class UserFixtures extends Fixture implements DependentFixtureInterface
{

    private UserPasswordHasherInterface $passwordHasher;

public function __construct(UserPasswordHasherInterface $passwordHasher)
{
    $this->passwordHasher = $passwordHasher;
}

public function getDependencies(): array
    {
        return [
            RoleFixtures::class,
        ];
    }


    public function load(ObjectManager $manager): void
    {
        // Récupération des rôles par référence
        $adminRole = $this->getReference('role_ADMIN', Role::class);
        // $userRole = $this->getReference('role_USER', Role::class);

        // Création d'un utilisateur admin
        $admin = new User();
        $admin->setEmail('admin@free.fr');
        


// Hashage du mot de passe
$hashedPassword = $this->passwordHasher->hashPassword($admin, '1234');
$admin->setPassword($hashedPassword);

        $admin->addRole($adminRole);

        $manager->persist($admin);
        $manager->flush();
    }
}
