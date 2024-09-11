<?php

namespace App\Controller;

use App\Entity\Tissus;
use App\Form\TissusType;
use App\Repository\TissusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/tissus')]
final class TissusController extends AbstractController{
    #[Route(name: 'app_tissus_index', methods: ['GET'])]
    public function index(TissusRepository $tissusRepository): Response
    {
        return $this->render('tissus/index.html.twig', [
            'tissuses' => $tissusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tissus_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tissu = new Tissus();
        $form = $this->createForm(TissusType::class, $tissu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tissu);
            $entityManager->flush();

            return $this->redirectToRoute('app_tissus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tissus/new.html.twig', [
            'tissu' => $tissu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tissus_show', methods: ['GET'])]
    public function show(Tissus $tissu): Response
    {
        return $this->render('tissus/show.html.twig', [
            'tissu' => $tissu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tissus_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tissus $tissu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TissusType::class, $tissu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tissus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tissus/edit.html.twig', [
            'tissu' => $tissu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tissus_delete', methods: ['POST'])]
    public function delete(Request $request, Tissus $tissu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tissu->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tissu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tissus_index', [], Response::HTTP_SEE_OTHER);
    }
}
