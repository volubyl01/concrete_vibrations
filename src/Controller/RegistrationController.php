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

        // Création d'une instance du  formulaire d'inscription
        $form = $this->createForm(RegistrationType::class, $user);
        // Récupération des les données soumises par l'utilisateur
        $form->handleRequest($request);
        // debug 
        // dd($form->getErrors(true, false)); 


        // validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // Debug pour vérifier les données de l'utilisateur
            //   dd('Le formulaire est soumis et valide !');

            // récupère les roles sélectionnés par l'utilsiateur et les associe à l'utilisateur
            // $selectedRoles = $form->get('roles')->getData(); // Récupération des rôles depuis le formulaire
            // debug
            // dump($user, $user->getRoles()); 

            // si le role n'existe pas on l'ajoute à l'utilisateur
            if (!empty($selectedRoles)) {
                foreach ($selectedRoles as $role) {
                    $user->addRole($role);
                }
            }

            // Hachage du mot de passe
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

            // Attribuer le rôle ROLE_USER par défaut
            $roleRepository = $entityManager->getRepository(Role::class);
            $userRole = $roleRepository->findOneBy(['nameRole' => 'ROLE_USER']);
            // persistance ddes données de l'utilisateur dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();
            // debug
            // dd('Utilisateur enregistré !');
            // Message flash pour indiquer que l'inscription a réussi
            $this->addFlash('success', 'Votre compte a été créé avec succès ! Vous pouvez maintenant vous connecter.');
            return $this->redirectToRoute('app_login'); // Redirection vers la page de connexion après l'inscription
        }

        // Affichage du formulaire d'inscription dans le template Twig
        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
