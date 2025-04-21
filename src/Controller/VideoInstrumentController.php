<?php

namespace App\Controller;

use App\Entity\SelectedVideo;
use App\Entity\Instrument;
use App\Form\VideoInstrumentType;
use App\Repository\InstrumentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoInstrumentController extends AbstractController
{
    #[Route('/associer-video-instrument', name: 'associer_video_instrument')]
    public function associer(Request $request, InstrumentRepository $instrumentRepository, EntityManagerInterface $em): Response
    {

        $user = $this->getUser();

        // Passer l'utilisateur actuel au formulaire
        $form = $this->createForm(VideoInstrumentType::class, null, [
            'user' => $this->getUser(),
        ]);

        // $form = $this->createForm(VideoInstrumentType::class);

        // >>> récupération des instruments avec un query_builder<<<
        $instruments = $instrumentRepository->createQueryBuilder('i')
            ->orderBy('i.name_instr', 'ASC')
            ->getQuery()
            ->getResult();

        
         // Récupération des vidéos sélectionnées par l'utilisateur
         $selectedVideos = $em->getRepository(SelectedVideo::class)->findBy(['user' => $user]);    


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            /** @var SelectedVideo $video */
            $selectedVideo = $data['selectedvideo'];
            /** @var Instrument $instrument */
            $instrument = $data['instrument'];

            // $selectedVideo->setInstrument($instrument);

            // Associer l'utilisateur courant avant le flush
            $user = $this->getUser();
            if ($user) {
                $selectedVideo->setUser($user);
            }
            // Associer l'instrument avant le flush
            if ($instrument) {

                $selectedVideo->setInstrument($instrument);
            }

            $em->persist($selectedVideo);

            $em->flush();

            $this->addFlash('success', 'Instrument associé à la vidéo !');
            return $this->redirectToRoute('associer_video_instrument');
        }

        return $this->render('video_instrument/video-instrument.html.twig', [
            'form' => $form->createView(),
            'instruments' => $instruments,
            'selectedVideos' => $selectedVideos
        ]);
    }
}
