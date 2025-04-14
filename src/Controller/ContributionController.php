<?php

namespace App\Controller;

use App\Entity\Contribution;
use App\Form\ContributionType;
use App\Repository\ContributionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/contribution')]
final class ContributionController extends AbstractController
{
    #[Route(name: 'app_contribution_index', methods: ['GET'])]
    public function index(ContributionRepository $contributionRepository): Response
    {
        return $this->render('contribution/index.html.twig', [
            'contributions' => $contributionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_contribution_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contribution = new Contribution();
        $form = $this->createForm(ContributionType::class, $contribution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contribution);
            $entityManager->flush();

            return $this->redirectToRoute('app_contribution_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contribution/new.html.twig', [
            'contribution' => $contribution,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contribution_show', methods: ['GET'])]
    public function show(Contribution $contribution): Response
    {
        return $this->render('contribution/show.html.twig', [
            'contribution' => $contribution,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_contribution_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contribution $contribution, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContributionType::class, $contribution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_contribution_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contribution/edit.html.twig', [
            'contribution' => $contribution,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contribution_delete', methods: ['POST'])]
    public function delete(Request $request, Contribution $contribution, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contribution->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($contribution);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_contribution_index', [], Response::HTTP_SEE_OTHER);
    }
}
