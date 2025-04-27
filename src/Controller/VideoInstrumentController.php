<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\Instrument;
use App\Entity\SelectedVideo;
use App\Form\VideoInstrumentType;
use App\Repository\InstrumentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User; // Import de l'entité User
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VideoInstrumentController extends AbstractController
{
    #[Route('/associer-video-instrument', name: 'associer_video_instrument')]
    public function associer(Security $security, Request $request, InstrumentRepository $instrumentRepository, EntityManagerInterface $em): Response
    {
        // $user = $this->getUser();

        $user = $security->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException('Vous devez être connecté.');
        }

        $form = $this->createForm(VideoInstrumentType::class, null, [
            'user' => $this->getUser(),
        ]);

        $instruments = $instrumentRepository->createQueryBuilder('i')
            ->orderBy('i.name_instr', 'ASC')
            ->getQuery()
            ->getResult();

        $selectedVideos = $em->getRepository(SelectedVideo::class)->findBy(['user' => $user]);

        $form->handleRequest($request);

        // Vérifie si le formulaire a été soumis
        // et s'il est valide
        if ($form->isSubmitted()) {
            // Ajoute un message flash que le formulaire soit valide ou non
            $this->addFlash('info', 'Formulaire soumis');

            if (!$form->isValid()) {
                foreach ($form->getErrors(true) as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }
        }


        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getErrors(true, false));

            $data = $form->getData();
            dump($data); // Affiche toutes les données du formulaire

            $selectedVideoId = $data['selectedvideo'] ?? null; // Récupère l'ID de la vidéo sélectionnée
            $instrumentId = $data['instrument'] ?? null;
            dump($selectedVideoId, $instrumentId); // Affiche les IDs de la vidéo et de l'instrument

            $selectedVideo = $em->getRepository(SelectedVideo::class)->find($selectedVideoId);
            $instrument = $em->getRepository(Instrument::class)->find($instrumentId);
            dump($selectedVideo, $instrument); // Affiche les entités récupérées (ou null si non trouvées)


            // if (!$selectedVideoId || !$instrumentId) {
            //     $this->addFlash('error', 'Veuillez sélectionner une vidéo et un instrument.');
            //     return $this->redirectToRoute('associer_video_instrument');
            // }

            if (!$selectedVideoId) {
                $this->addFlash('error', 'Veuillez sélectionner une vidéo.');
                return $this->redirectToRoute('associer_video_instrument');
            }

            if (!$instrumentId) {
                $this->addFlash('error', 'Veuillez sélectionner un instrument.');
                return $this->redirectToRoute('associer_video_instrument');
            }

            $selectedVideo->setInstrument($instrument);

            if ($user) {
                $selectedVideo->setUser($user);
            }

            // Promotion de l'utilisateur au rôle ROLE_CREAT
            // Vérification que l'utilisateur a le rôle ROLE_USER
            if ($user instanceof User) { // Vérifie que $user est bien une instance de User
                $roleUser = $em->getRepository(Role::class)->findOneBy(['nameRole' => 'ROLE_USER']);

                if ($roleUser && $user->getRolesCollection()->contains($roleUser)) {
                    // L'utilisateur a le rôle ROLE_USER
                    // Ici, par exemple, on peut promouvoir au rôle ROLE_CREAT
                    $roleCreat = $em->getRepository(Role::class)->findOneBy(['nameRole' => 'ROLE_CREAT']);

                    if ($roleCreat && !$user->getRolesCollection()->contains($roleCreat)) {
                        $user->addRole($roleCreat);
                        $em->persist($user);
                    }
                }
            }

            $em->persist($selectedVideo);
            $em->flush();

            $this->addFlash('success', 'Instrument associé à la vidéo !');
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
