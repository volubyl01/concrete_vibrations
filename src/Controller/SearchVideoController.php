<?php

namespace App\Controller;

use App\Form\SearchVideoType;
use App\Service\YoutubeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchVideoController extends AbstractController
{
    private $backgroundImages = [
        'search' => 'images/backgrounds/AdobeStock_585885970.webp',
    ];

    #[Route('/youtube-search', name: 'app_youtube_search')]
    public function search(YoutubeService $youtubeService, Request $request): Response
    {
        $form = $this->createForm(SearchVideoType::class);
        $form->handleRequest($request);

        $videos = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $query = $form->get('query')->getData();
            // $regionCode = $form->get('region_code')->getData();
            // $videoCategory = $form->get('video_category_id')->getData();
            $maxResults = $form->get('max_results')->getData();

            $videos = $youtubeService->searchVideos($query, $maxResults);
        }

        return $this->render('youtube/search.html.twig', [
            'form' => $form->createView(),
            'videos' => $videos,
            'backgroundImage' => $this->backgroundImages['search'],
        ]);
    }
}
