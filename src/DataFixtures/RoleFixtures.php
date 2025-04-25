<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Permission;
use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies(): array // Specify the dependencies for this fixture retourne un tableau car definit comme cela
    // dans l'interface DependentFixtureInterface
    // Cette méthode est appelée par Doctrine pour charger les fixtures dans le bon ordre.
    {
        return [
            PermissionFixtures::class,
        ];
    }


    public function load(ObjectManager $manager): void
    {

        // Voir version de DoctrineFixturesBundle 3.0.0 : on précise 2 argument pour getreference
        $createUserPermission = $this->getReference('permission_CREATE_USER', Permission::class);
        $editUserPermission = $this->getReference('permission_EDIT_USER', Permission::class);
        $deleteUserPermission = $this->getReference('permission_DELETE_USER', Permission::class);
        $viewUserPermission = $this->getReference('permission_VIEW_USER', Permission::class);

        $createCommentPermission = $this->getReference('permission_CREATE_COMMENT', Permission::class);
        $editCommentPermission = $this->getReference('permission_EDIT_COMMENT', Permission::class);
        $deleteCommentPermission = $this->getReference('permission_DELETE_COMMENT', Permission::class);
        $viewCommentPermission = $this->getReference('permission_VIEW_COMMENT', Permission::class);

        $createContributionPermission = $this->getReference('permission_CREATE_CONTRIBUTION', Permission::class);
        $editContributionPermission = $this->getReference('permission_EDIT_CONTRIBUTION', Permission::class);
        $deleteContributionPermission = $this->getReference('permission_DELETE_CONTRIBUTION', Permission::class);
        $viewContributionPermission = $this->getReference('permission_VIEW_CONTRIBUTION', Permission::class);

        $createInformationPermission = $this->getReference('permission_CREATE_INFORMATION', Permission::class);
        $editInformationPermission = $this->getReference('permission_EDIT_INFORMATION', Permission::class);
        $deleteInformationPermission = $this->getReference('permission_DELETE_INFORMATION', Permission::class);
        $viewInformationPermission = $this->getReference('permission_VIEW_INFORMATION', Permission::class);

        $createInstrumentPermission = $this->getReference('permission_CREATE_INSTRUMENT', Permission::class);
        $editInstrumentPermission = $this->getReference('permission_EDIT_INSTRUMENT', Permission::class);
        $deleteInstrumentPermission = $this->getReference('permission_DELETE_INSTRUMENT', Permission::class);
        $viewInstrumentPermission = $this->getReference('permission_VIEW_INSTRUMENT', Permission::class);

        $createPermissionPermission = $this->getReference('permission_CREATE_PERMISSION', Permission::class);
        $editPermissionPermission = $this->getReference('permission_EDIT_PERMISSION', Permission::class);
        $deletePermissionPermission = $this->getReference('permission_DELETE_PERMISSION', Permission::class);
        $viewPermissionPermission = $this->getReference('permission_VIEW_PERMISSION', Permission::class);

        $createRolePermission = $this->getReference('permission_CREATE_ROLE', Permission::class);
        $editRolePermission = $this->getReference('permission_EDIT_ROLE', Permission::class);
        $deleteRolePermission = $this->getReference('permission_DELETE_ROLE', Permission::class);
        $viewRolePermission = $this->getReference('permission_VIEW_ROLE', Permission::class);

        $createSelectedVideoPermission = $this->getReference('permission_CREATE_SELECTEDVIDEO', Permission::class);
        $editSelectedVideoPermission = $this->getReference('permission_EDIT_SELECTEDVIDEO', Permission::class);
        $deleteSelectedVideoPermission = $this->getReference('permission_DELETE_SELECTEDVIDEO', Permission::class);
        $viewSelectedVideoPermission = $this->getReference('permission_VIEW_SELECTEDVIDEO', Permission::class);


        // Création du role standard user
        $roleStandardUser = new Role();
        $roleStandardUser->setNameRole('ROLE_USER')
            ->addPermission($viewUserPermission)
            ->addPermission($createCommentPermission)
            ->addPermission($editCommentPermission)
            ->addPermission($deleteCommentPermission)
            ->addPermission($viewCommentPermission)
           
            ->addPermission($viewContributionPermission)

            ->addPermission($createInformationPermission)
            ->addPermission($editInformationPermission)
            ->addPermission($deleteInformationPermission)
            ->addPermission($viewInformationPermission)

            ->addPermission($viewInstrumentPermission)

            ->addPermission($viewPermissionPermission)

            ->addPermission($createSelectedVideoPermission)
            ->addPermission($editSelectedVideoPermission)
            ->addPermission($deleteSelectedVideoPermission)
            ->addPermission($viewSelectedVideoPermission);

        // Persist the role entity
        $manager->persist($roleStandardUser);




        // Création du role Administrateur
        $roleAdmin = new Role();
        $roleAdmin->setNameRole('ROLE_ADMIN')
            ->addPermission($createUserPermission)
            ->addPermission($editUserPermission)
            ->addPermission($deleteUserPermission)
            ->addPermission($viewUserPermission)
            ->addPermission($createCommentPermission)
            ->addPermission($editCommentPermission)
            ->addPermission($deleteCommentPermission)
            ->addPermission($viewCommentPermission)
            ->addPermission($createContributionPermission)
            ->addPermission($editContributionPermission)
            ->addPermission($deleteContributionPermission)
            ->addPermission($viewContributionPermission)
            ->addPermission($createInformationPermission)
            ->addPermission($editInformationPermission)
            ->addPermission($deleteInformationPermission)
            ->addPermission($viewInformationPermission)
            ->addPermission($createInstrumentPermission)
            ->addPermission($editInstrumentPermission)
            ->addPermission($deleteInstrumentPermission)
            ->addPermission($viewInstrumentPermission)
            ->addPermission($createPermissionPermission)
            ->addPermission($editPermissionPermission)
            ->addPermission($deletePermissionPermission)
            ->addPermission($viewPermissionPermission)
            ->addPermission($createRolePermission)
            ->addPermission($editRolePermission)
            ->addPermission($deleteRolePermission)
            ->addPermission($viewRolePermission)
            ->addPermission($createSelectedVideoPermission)
            ->addPermission($editSelectedVideoPermission)
            ->addPermission($deleteSelectedVideoPermission)
            ->addPermission($viewSelectedVideoPermission);

        // Persist the role entity
        $manager->persist($roleAdmin);

        // Création du role Creator_Role
        $roleCreator = new Role();
        $roleCreator->setNameRole('ROLE_CREAT')
           
        
            ->addPermission($viewUserPermission)

            ->addPermission($createCommentPermission)
            ->addPermission($editCommentPermission)
            ->addPermission($deleteCommentPermission)
            ->addPermission($viewCommentPermission)
            
            ->addPermission($createContributionPermission)
            ->addPermission($editContributionPermission)
            ->addPermission($deleteContributionPermission)
            ->addPermission($viewContributionPermission)

            ->addPermission($createInformationPermission)
            ->addPermission($editInformationPermission)
            ->addPermission($deleteInformationPermission)
            ->addPermission($viewInformationPermission)

            ->addPermission($createInstrumentPermission)
            ->addPermission($editInstrumentPermission)
            ->addPermission($deleteInstrumentPermission)
            ->addPermission($viewInstrumentPermission)

            ->addPermission($viewPermissionPermission)

            ->addPermission($viewRolePermission)

            ->addPermission($createSelectedVideoPermission)
            ->addPermission($editSelectedVideoPermission)
            ->addPermission($deleteSelectedVideoPermission)
            ->addPermission($viewSelectedVideoPermission);

        // Persist the role entity
        $manager->persist($roleCreator);


// Sauvegarde en base
        $manager->flush();
        echo "Rôles et permissions insérés avec succès !\n";

           // Ajout de références pour réutiliser ces rôles dans d'autres fixtures (ex : UserFixtures)
           $this->addReference('role_ADMIN', $roleAdmin);
           $this->addReference('role_EDITOR', $roleStandardUser);
           $this->addReference('role_VIEWER', $roleCreator);
    }
}
