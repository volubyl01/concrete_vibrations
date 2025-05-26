<?php

namespace App\Controller;

use App\Entity\Instrument;
use App\Entity\SelectedVideo;
use App\Form\VideoInstrumentType;
use App\Repository\InstrumentRepository;
use App\Service\VideoAssociationManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VideoInstrumentController extends AbstractController
{
    #[Route('/associer-video-instrument', name: 'associer_video_instrument')]
    public function associer(
        Security $security,
        Request $request,
        InstrumentRepository $instrumentRepository,
        EntityManagerInterface $em,
        VideoAssociationManager $videoAssociationManager
    ): Response {
        $user = $security->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException('Vous devez être connecté.');
        }

        $form = $this->createForm(VideoInstrumentType::class, null, [
            'user' => $user,
        ]);

        $instruments = $instrumentRepository->createQueryBuilder('i')
            ->orderBy('i.name_instr', 'ASC')
            ->getQuery()
            ->getResult();

        $selectedVideos = $em->getRepository(SelectedVideo::class)->findBy(['user' => $user]);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $this->addFlash('info', 'Formulaire soumis');

            if (!$form->isValid()) {
                foreach ($form->getErrors(true) as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $selectedVideoId = $data['selectedvideo'] ?? null;
            $instrumentId = $data['instrument'] ?? null;

            $selectedVideo = $em->getRepository(SelectedVideo::class)->find($selectedVideoId);
            $instrument = $em->getRepository(Instrument::class)->find($instrumentId);

            if (!$selectedVideo) {
                $this->addFlash('error', 'Veuillez sélectionner une vidéo.');
                return $this->redirectToRoute('associer_video_instrument');
            }

            if (!$instrument) {
                $this->addFlash('error', 'Veuillez sélectionner un instrument.');
                return $this->redirectToRoute('associer_video_instrument');
            }

            try {
                $videoAssociationManager->associate($instrument, $selectedVideo, $user, $em);
                $em->persist($selectedVideo);
                $em->flush();
                $this->addFlash('success', 'Instrument associé à la vidéo !');
            } catch (\LogicException $e) {
                $this->addFlash('error', $e->getMessage());
            }

            return $this->redirectToRoute('associer_video_instrument');
        }

        return $this->render('video_instrument/video-instrument.html.twig', [
            'form' => $form->createView(),
            'instruments' => $instruments,
            'selectedVideos' => $selectedVideos,
        ]);
    }

    #[Route('/test-flash', name: 'test_flash')]
    public function testFlash()
    {
        $this->addFlash('success', 'Message flash de test');
        return $this->redirectToRoute('associer_video_instrument');
    }
}
