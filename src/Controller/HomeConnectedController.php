<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeConnectedController extends AbstractController
{

// on chisiit ses backgrounds par méthode
private $backgroundVideos = [
    'home-connected' => 'public/videos/abstract-green-line-waves (720p).mp4',
];

    #[Route('/home-connected', name: 'app_home_connected')]
    public function index(): Response
    {

// Si l'utilisateur ,'est pas connecté, on le redirige
if (!$this->getUser()) {
    return $this->redirectToRoute('app_home');
}



        return $this->render('home-connected/index.html.twig', [
            'controller_name' => 'HomeConnectedController',
            'backgroundVideo' => $this->backgroundVideos['home-connected'],
        ]);
    }
}
