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
        // debug 
        // dd($form->getErrors(true, false)); 

        if ($form->isSubmitted() && $form->isValid()) {
            // Debug pour vérifier les données de l'utilisateur
            //   dd('Le formulaire est soumis et valide !');
           
            // Gestion des rôles sélectionnés
            $selectedRoles = $form->get('roles')->getData(); // Récupération des rôles depuis le formulaire
            // debug
            // dump($user, $user->getRoles()); 

            if (!empty($selectedRoles)) {
                foreach ($selectedRoles as $role) {
                    $user->addRole($role);
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


            // // Persister l'utilisateur
            // try {
            //     $entityManager->persist($user);
            //     // Synchronisation des données persistées avec la base de données
            //     $entityManager->flush();
            //     dd('Utilisateur enregistré !');
            // } catch (\Exception $e) {
            //     return new Response(sprintf('Une erreur est survenue lors de l\'enregistrement : %s', $e->getMessage()));
            // }

            $entityManager->persist($user);
            $entityManager->flush();
            // debug
            // dd('Utilisateur enregistré !');

            // Redirection vers la page de connexion après succès
            return $security->login($user, 'form_login', 'main');
        }

        // Affichage du formulaire d'inscription dans le template Twig
        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
