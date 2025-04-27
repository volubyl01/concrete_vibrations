<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        RoleRepository $roleRepository,
        UserRepository $userRepository,
    ): Response {
        // Création d'un nouvel utilisateur
        $user = new User();

        // Création du formulaire d'inscription
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération des rôles sélectionnés dans le formulaire (si tu as ce champ)
            $selectedRoles = $form->has('roles') ? $form->get('roles')->getData() : [];

            // Vérifier si l'email existe déjà
            $existingUser = $userRepository->findOneBy(['email' => $user->getEmail()]);
            if ($existingUser) {
                // Ajouter une erreur au formulaire
                $form->get('email')->addError(new FormError('Cette adresse email est déjà utilisée.'));
                // On ne redirige pas ici, on laisse passer pour afficher le formulaire avec l'erreur
            } else {
                // Gestion des rôles
                if (!empty($selectedRoles)) {
                    // Ajout des rôles sélectionnés à l'utilisateur
                    foreach ($selectedRoles as $role) {
                        $user->addRole($role);
                    }
                } else {
                    // Si aucun rôle sélectionné, on ajoute ROLE_USER par défaut
                    $userRole = $roleRepository->findOneBy(['nameRole' => 'ROLE_USER']);
                    if ($userRole) {
                        $user->addRole($userRole);
                    } else {
                        throw new \Exception('Le rôle ROLE_USER est introuvable en base.');
                    }
                }

                // Hachage du mot de passe
                $plaintextPassword = $form->get('password')->getData();
                if ($plaintextPassword) {
                    $hashedPassword = $passwordHasher->hashPassword($user, $plaintextPassword);
                    $user->setPassword($hashedPassword);
                } else {
                    throw new \Exception('Le mot de passe est requis.');
                }

                // Persistance en base
                $entityManager->persist($user);
                $entityManager->flush();

                // Message flash et redirection
                $this->addFlash('success', 'Votre compte a été créé avec succès ! Vous pouvez maintenant vous connecter.');
                return $this->redirectToRoute('app_login');
            }
        }

        // Affichage du formulaire (avec ou sans erreurs)
        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
