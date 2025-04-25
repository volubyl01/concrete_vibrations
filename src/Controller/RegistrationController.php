<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RegistrationType;
use App\Repository\RoleRepository;
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
    RoleRepository $roleRepository,
): Response {
    
    // Création d'un nouvel utilisateur
    $user = new User();

    // Création du formulaire d'inscription
    $form = $this->createForm(RegistrationType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Pas Récupération des rôles sélectionnés dans le formulaire (si tu as ce champ)
        // $selectedRoles = $form->get('roles')->getData(); // si récupération des roles

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

    return $this->render('registration/index.html.twig', [
        'form' => $form->createView(),
    ]);
}
}
