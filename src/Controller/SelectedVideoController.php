<?php

namespace App\Controller;

use App\Entity\SelectedVideo;
use App\Form\SelectedVideoType;
use App\Service\YoutubeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[Route('/selected/video', name: 'app_selected_video_list_')]
class SelectedVideoController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $em): Response
    {
        $videos = $em->getRepository(SelectedVideo::class)->findAll();

        return $this->render('selected_video/index.html.twig', [
            'videos' => $videos,
        ]);
    }

    #[Route('/select/{youtubeId}', name: 'select')]
    public function select(
        string $youtubeId,
        Request $request,
        EntityManagerInterface $em,
        YoutubeService $youtubeService
    ): Response {
        $youtubeData = $youtubeService->getVideoDetails($youtubeId);

        $selectedVideo = new SelectedVideo();
        $selectedVideo->setVideoId($youtubeId);
        $selectedVideo->setTitle($youtubeData['snippet']['title'] ?? '');
        $selectedVideo->setThumbnailUrl($youtubeData['snippet']['thumbnails']['default']['url'] ?? '');

        if (!empty($youtubeData['snippet']['publishedAt'])) {
            try {
                $publishedAt = new \DateTime($youtubeData['snippet']['publishedAt']);
                $publishedAtForForm = $publishedAt->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                $publishedAt = null;
                $publishedAtForForm = null;
            }
        } else {
            $publishedAtForForm = null;
        }
        $selectedVideo->setPublishedAt($publishedAt);

        $form = $this->createForm(SelectedVideoType::class, $selectedVideo, [
            'publishedAt_hidden' => $publishedAtForForm,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $selectedVideo->setSelectedAt(new \DateTime());
            $em->persist($selectedVideo);
            $em->flush();

            $this->addFlash('success', 'Vidéo enregistrée avec succès !');
            return $this->redirectToRoute('app_selected_video_list_index');
        }

        return $this->render('selected_video/select.html.twig', [
            'form' => $form->createView(),
            'youtubeData' => $youtubeData,
            'publishedAt' => $publishedAt,
            'videoId' => $youtubeId,
        ]);
    }
}
