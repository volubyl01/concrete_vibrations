<?php

namespace App\Controller;

use App\Entity\Instrument;
use App\Form\InstrumentType;
use App\Data\InstrumentSearchData;
use App\Form\InstrumentSearchType;
use App\Repository\InstrumentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



// Route pour les synthétiseurs uniquement
#[Route('/instruments')]
final class InstrumentController extends AbstractController
{
    #[Route('/synthetiseurs', name: 'instrument_synths', methods: ['GET'])]
    // on utilise une route regexp pour filtrer les types d'instruments
    public function synths(InstrumentRepository $instrumentRepository): Response
    {
        // On récupère les instruments de type synthetiseur
        $instruments = $instrumentRepository->findBy(['type_instr' => 'synthetiseur']);

        return $this->render('instrument/synth.html.twig', [
            'instruments' => $instruments,
        ]);
    }

    // Route pour rechercher parmi tous les instruments 
    #[Route('/recherche', name: 'app_instrument_search', methods: ['GET'])]
    public function search(InstrumentRepository $instrumentRepository, Request $request): Response
    {

        $searchData = new InstrumentSearchData();
        $form = $this->createForm(InstrumentSearchType::class, $searchData);
        $form->handleRequest($request);

        $instruments = $instrumentRepository->findSearch($searchData);

        return $this->render('instrument/index.html.twig', [
            // 'instruments' => $instrumentRepository->findAll(),
            'instruments' => $instruments,
            'form' => $form->createView(),
        ]);
    }

    // Route pour afficher tous les instruments => poser limite date
    #[Route('/recherche', name: 'app_instrument_index', methods: ['GET'])]
    public function index(InstrumentRepository $instrumentRepository, Request $request): Response
    {

        $searchData = new InstrumentSearchData();
        $form = $this->createForm(InstrumentSearchType::class, $searchData);
        $form->handleRequest($request);

        $instruments = $instrumentRepository->findSearch($searchData);

        return $this->render('instrument/index.html.twig', [
            'instruments' => $instrumentRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }



    #[Route('/new', name: 'app_instrument_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $instrument = new Instrument();
        $form = $this->createForm(InstrumentType::class, $instrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($instrument);
            $entityManager->flush();

            return $this->redirectToRoute('app_instrument_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('instrument/new.html.twig', [
            'instrument' => $instrument,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_instrument_show', methods: ['GET'])]
    public function show(Instrument $instrument): Response
    {
        return $this->render('instrument/show.html.twig', [
            'instrument' => $instrument,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_instrument_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Instrument $instrument, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InstrumentType::class, $instrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_instrument_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('instrument/edit.html.twig', [
            'instrument' => $instrument,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_instrument_delete', methods: ['POST'])]
    public function delete(Request $request, Instrument $instrument, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $instrument->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($instrument);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_instrument_index', [], Response::HTTP_SEE_OTHER);
    }
}
