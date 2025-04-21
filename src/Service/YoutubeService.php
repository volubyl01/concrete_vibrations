<?php

namespace App\Service;

use Exception;
use Google\Client;
use Google\Service\YouTube;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class YoutubeService
{
    private $youtube;

    public function __construct(HttpClientInterface $httpClient, string $apiKey)
    {
        $client = new Client();
        $client->setDeveloperKey($apiKey);
        $this->youtube = new YouTube($client);
    }

    public function searchVideos($query, $maxResults, $videoCategory = null, $regionCode = null)
    {
        try {
            $params = [
                'q' => $query,
                'maxResults' => $maxResults,
                'type' => 'video',
                'fields' => 'items(id/videoId,snippet/title,snippet/thumbnails/default,snippet/thumbnails/medium,snippet/thumbnails/high,snippet/publishedAt)',
            ];

            if ($videoCategory) {
                $params['videoCategoryId'] = $videoCategory;
            }

            if ($regionCode) {
                $params['regionCode'] = $regionCode;
            }

            $searchResponse = $this->youtube->search->listSearch('id,snippet', $params);

            $videos = [];

            foreach ($searchResponse->items as $searchResult) {
                // Récupère la meilleure vignette disponible
                $thumbnailUrl = $searchResult->snippet->thumbnails->high->url
                    ?? $searchResult->snippet->thumbnails->medium->url
                    ?? $searchResult->snippet->thumbnails->default->url
                    ?? null;

                if (isset($searchResult->id->videoId, $searchResult->snippet->title, $thumbnailUrl)) {
                    $videos[] = [
                        'videoId' => $searchResult->id->videoId,
                        'title' => $searchResult->snippet->title,
                        'thumbnailUrl' => $thumbnailUrl,
                        'publishedAt' => $searchResult->snippet->publishedAt ?? null,
                    ];
                }
            }

            return $videos;
        } catch (Exception $e) {
            throw new Exception('Erreur lors de la recherche de vidéos sur YouTube : ' . $e->getMessage());
        }
    }

    public function getVideoDetails($videoId)
    {
        try {
            $response = $this->youtube->videos->listVideos('snippet,contentDetails', [
                'id' => $videoId,
                'fields' => 'items(id,snippet/title,snippet/description,snippet/thumbnails/default,snippet/thumbnails/medium,snippet/thumbnails/high,snippet/publishedAt,contentDetails/duration)',
                'maxResults' => 1,
            ]);

            if (count($response->items) > 0) {
                return $response->items[0];
            } else {
                throw new Exception('Aucune vidéo trouvée avec cet ID.');
            }
        } catch (Exception $e) {
            throw new Exception('Erreur lors de la récupération des détails de la vidéo : ' . $e->getMessage());
        }
    }

    public function getVideoComments($videoId, $maxResults = 10)
    {
        try {
            $response = $this->youtube->commentThreads->listCommentThreads('snippet', [
                'videoId' => $videoId,
                'maxResults' => $maxResults,
                'textFormat' => 'plainText',
            ]);

            return $response->items;
        } catch (Exception $e) {
            throw new Exception('Erreur lors de la récupération des commentaires de la vidéo : ' . $e->getMessage());
        }
    }
}
