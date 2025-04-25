<?php

namespace App\Controller;

use App\Entity\SelectedVideo;
use App\Repository\SelectedVideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class YoutubeRepository extends AbstractController
{
    private $entityManager;
    private $httpClient;
    private $videoRepository;
    private $apiKey;

    public function __construct(
        EntityManagerInterface $entityManager,
        HttpClientInterface $httpClient,
        SelectedVideoRepository $videoRepository
    ) {
        $this->entityManager = $entityManager;
        $this->httpClient = $httpClient;
        $this->videoRepository = $videoRepository;
        $this->apiKey = $this->getParameter('apiKey');
    }

    /**
     * @Route("/admin/youtube/save-video", name="admin_youtube_save_video", methods={"POST"})
     */
    public function saveVideo(Request $request): Response
    {
        $videoId = $request->request->get('video_id');
        
        if (!$videoId) {
            return new JsonResponse(['error' => 'ID de vidéo manquant'], Response::HTTP_BAD_REQUEST);
        }

        // Vérifier si la vidéo existe déjà dans la base de données
        $existingVideo = $this->videoRepository->findOneBy(['youtubeId' => $videoId]);
        if ($existingVideo) {
            return new JsonResponse([
                'message' => 'Cette vidéo existe déjà dans la base de données',
                'video' => [
                    'id' => $existingVideo->getId(),
                    'title' => $existingVideo->getTitle()
                ]
            ]);
        }

        // Récupérer les données de la vidéo depuis l'API YouTube
        try {
            $videoData = $this->getYoutubeVideoData($videoId);
            
            if (!$videoData) {
                return new JsonResponse(['error' => 'Vidéo non trouvée'], Response::HTTP_NOT_FOUND);
            }

            // Créer une nouvelle entité Selected Video
            $video = new SelectedVideo();
            $video->setVideoId($videoId);
            $video->setTitle($videoData['title']);
            // $video->setDescription($videoData['description']);
            $video->setThumbnailUrl($videoData['thumbnailUrl']);

            // Persister dans la base de données
            $this->entityManager->persist($video);
            $this->entityManager->flush();

            return new JsonResponse([
                'message' => 'Vidéo enregistrée avec succès',
                'video' => [
                    'id' => $video->getId(),
                    'title' => $video->getTitle()
                ]
            ], Response::HTTP_CREATED);
            
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Erreur lors de la récupération des données: ' . $e->getMessage()], 
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Récupère les données d'une vidéo YouTube via l'API
     */
    private function getYoutubeVideoData(string $videoId): ?array
    {
        $url = sprintf(
            'https://www.googleapis.com/youtube/v3/videos?id=%s&key=%s&part=snippet',
            $videoId,
            $this->apiKey
        );

        $response = $this->httpClient->request('GET', $url);
        $data = json_decode($response->getContent(), true);

        if (!isset($data['items'][0])) {
            return null;
        }

        $snippet = $data['items'][0]['snippet'];
        
        return [
            'title' => $snippet['title'],
            'description' => $snippet['description'],
            'thumbnailUrl' => $snippet['thumbnails']['high']['url'] ?? $snippet['thumbnails']['default']['url'],
            'channelTitle' => $snippet['channelTitle'],
            'publishedAt' => $snippet['publishedAt']
        ];
    }
}