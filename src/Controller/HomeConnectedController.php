<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeConnectedController extends AbstractController
{
    #[Route('/home/connected', name: 'app_home_connected')]
    public function index(): Response
    {
        return $this->render('home_connected/index.html.twig', [
            'controller_name' => 'HomeConnectedController',
        ]);
    }
}
