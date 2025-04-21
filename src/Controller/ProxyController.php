<?php

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProxyController extends AbstractController
{
    #[Route('/proxy-googleads', name: 'proxy_googleads', methods: ['GET', 'OPTIONS'])]
    public function proxyGoogleAds(Request $request): JsonResponse
    {

        if ($request->getMethod() === 'OPTIONS') {
            $response = new JsonResponse(null, 204);
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, OPTIONS');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type');
            return $response;
        }


        $client = HttpClient::create();
        $response = $client->request('GET', 'https://googleads.g.doubleclick.net/pagead/id');

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();

        // Nettoie le préfixe s'il existe
        $cleaned = preg_replace('/^[^\[{]+/', '', trim($content));

        // Décode le JSON en tableau PHP
        $data = json_decode($cleaned, true);

        // Si le décodage échoue, retourne une erreur
        // Si le décodage échoue, retourne une erreur
    if ($data === null) {
        $jsonResponse = new JsonResponse(['error' => 'Invalid JSON from upstream'], 502);
    } else {
        $jsonResponse = new JsonResponse($data, $statusCode);
    }

    // Ajoute les en-têtes CORS
    $jsonResponse->headers->set('Access-Control-Allow-Origin', '*');
    $jsonResponse->headers->set('Access-Control-Allow-Methods', 'GET, OPTIONS');
    $jsonResponse->headers->set('Access-Control-Allow-Headers', 'Content-Type');

        return $jsonResponse;
    }
}
