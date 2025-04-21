<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{


// on chisiit ses backgrounds par méthode
private $backgroundVideos = [
    'home' => 'public/videos/vidsplay-abstract-digital-waves.mp4 (1080p).mp4',
];

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'bodyClass' => 'home',
            'backgroundVideo' => $this->backgroundVideos['home'],
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('about/about.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}
