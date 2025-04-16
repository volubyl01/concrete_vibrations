<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CspReportController
{
    #[Route('/nelmio/csp/report', methods: ['POST'], name: 'nelmio_security_csp_report')]
    public function index(Request $request): Response
    {
        $content = $request->getContent();
        // Logue ou traite le rapport ici, par exemple avec Monolog
        // $this->logger->info('CSP Report: ' . $content);

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
