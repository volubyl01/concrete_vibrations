<?php

namespace App\DataFixtures;

use App\Entity\Permission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PermissionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $permissions = [
            'CREATE_USER',
            'EDIT_USER',
            'DELETE_USER',
            'VIEW_USER',
            'CREATE_COMMENT',
            'EDIT_COMMENT',
            'DELETE_COMMENT',
            'VIEW_COMMENT',
            'CREATE_CONTRIBUTION',
            'EDIT_CONTRIBUTION',
            'DELETE_CONTRIBUTION',
            'VIEW_CONTRIBUTION',
            'CREATE_INFORMATION',
            'EDIT_INFORMATION',
            'DELETE_INFORMATION',
            'VIEW_INFORMATION',
            'CREATE_INSTRUMENT',
            'EDIT_INSTRUMENT',
            'DELETE_INSTRUMENT',
            'VIEW_INSTRUMENT',
            'CREATE_PERMISSION',
            'EDIT_PERMISSION',
            'DELETE_PERMISSION',
            'VIEW_PERMISSION',
            'CREATE_ROLE',
            'EDIT_ROLE',
            'DELETE_ROLE',
            'VIEW_ROLE',
            'CREATE_SELECTEDVIDEO',
            'EDIT_SELECTEDVIDEO',
            'DELETE_SELECTEDVIDEO',
            'VIEW_SELECTEDVIDEO',
        ];

        foreach ($permissions as $permDescription) {
            $permission = new Permission();
            $permission->setDescriptionPermission($permDescription);
            $manager->persist($permission);


            // Ajouter une référence pour réutiliser dans d'autres fixtures
            $this->addReference('permission_' . $permDescription, $permission);
        }

        // Optionally, you can create a default permission without a name
        // Uncomment the following lines if needed

        $permission = new Permission();
        $manager->persist($permission);

        $manager->flush();
    }
}
