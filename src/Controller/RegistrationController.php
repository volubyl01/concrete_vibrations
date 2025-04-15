<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;


final class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        Security $security,
    ): Response {
        // Création d'un nouvel utilisateur
        $user = new User();

        // Création du formulaire d'inscription
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion des rôles sélectionnés
            $selectedRoles = $form->get('roles')->getData(); // Récupération des rôles depuis le formulaire

            if (!empty($selectedRoles)) {
                foreach ($selectedRoles as $roleName) {
                    // Recherche du rôle dans la base de données
                    $role = $entityManager->getRepository(Role::class)->findOneBy(['name' => $roleName]);

                    if ($role) {
                        // Ajout du rôle à l'utilisateur voir addrole dans user
                        $user->addRole($role);
                    } else {
                        // Gestion des rôles non trouvés (optionnel)
                        throw new \Exception(sprintf('Le rôle "%s" n\'existe pas.', $roleName));
                    }
                }
            }

            // Récupérer le mot de passe depuis le formulaire
            $plaintextPassword = $form->get('password')->getData();

            if ($plaintextPassword) {
                // Hachage du mot de passe selon la configuration de sécurité
                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $plaintextPassword
                );
                $user->setPassword($hashedPassword);
            } else {
                throw new \Exception('Le mot de passe est requis.');
            }


            // Persister l'utilisateur
            try {
                $entityManager->persist($user);
                // Synchronisation des données persistées avec la base de données
                $entityManager->flush();
            } catch (\Exception $e) {
                return new Response(sprintf('Une erreur est survenue lors de l\'enregistrement : %s', $e->getMessage()));
            }

            // Redirection vers la page de connexion après succès
            return $security->login($user, 'form_login','main');
        }

        // Affichage du formulaire d'inscription dans le template Twig
        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
