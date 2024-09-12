<?php

namespace App\Controller;

use App\Entity\Pistolets;
use App\Form\PistoletsType;
use App\Repository\PistoletsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/pistolets')]
#[IsGranted('ROLE_ADMIN')]
final class PistoletsController extends AbstractController{
    #[Route(name: 'app_pistolets_index', methods: ['GET'])]
    public function index(PistoletsRepository $pistoletsRepository): Response
    {
        return $this->render('pistolets/index.html.twig', [
            'pistolets' => $pistoletsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pistolets_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pistolet = new Pistolets();
        $form = $this->createForm(PistoletsType::class, $pistolet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pistolet);
            $entityManager->flush();

            return $this->redirectToRoute('app_pistolets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pistolets/new.html.twig', [
            'pistolet' => $pistolet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pistolets_show', methods: ['GET'])]
    public function show(Pistolets $pistolet): Response
    {
        return $this->render('pistolets/show.html.twig', [
            'pistolet' => $pistolet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pistolets_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pistolets $pistolet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PistoletsType::class, $pistolet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_pistolets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pistolets/edit.html.twig', [
            'pistolet' => $pistolet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pistolets_delete', methods: ['POST'])]
    public function delete(Request $request, Pistolets $pistolet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pistolet->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($pistolet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pistolets_index', [], Response::HTTP_SEE_OTHER);
    }
}
