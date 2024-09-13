<?php

namespace App\Controller;

use App\Entity\Tondeuses;
use App\Form\TondeusesType;
use App\Repository\TondeusesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


#[Route('/tondeuses')]
#[IsGranted('ROLE_ADMIN')]
final class TondeusesController extends AbstractController{
    #[Route(name: 'app_tondeuses_index', methods: ['GET'])]
    public function index(TondeusesRepository $tondeusesRepository): Response
    {
        return $this->render('admin/tondeuses/index.html.twig', [
            'tondeuses' => $tondeusesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tondeuses_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tondeus = new Tondeuses();
        $form = $this->createForm(TondeusesType::class, $tondeus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tondeus);
            $entityManager->flush();

            return $this->redirectToRoute('app_tondeuses_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/tondeuses/new.html.twig', [
            'tondeus' => $tondeus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tondeuses_show', methods: ['GET'])]
    public function show(Tondeuses $tondeus): Response
    {
        return $this->render('admin/tondeuses/show.html.twig', [
            'tondeus' => $tondeus,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tondeuses_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tondeuses $tondeus, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TondeusesType::class, $tondeus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tondeuses_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/tondeuses/edit.html.twig', [
            'tondeus' => $tondeus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tondeuses_delete', methods: ['POST'])]
    public function delete(Request $request, Tondeuses $tondeus, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tondeus->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tondeus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tondeuses_index', [], Response::HTTP_SEE_OTHER);
    }
}
