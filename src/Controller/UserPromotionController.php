<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserPromotionController extends AbstractController
{
    #[Route('/user/promotion', name: 'app_user_promotion')]
    public function index(): Response
    {
        return $this->render('user_promotion/index.html.twig', [
            'controller_name' => 'UserPromotionController',
        ]);
    }
}
