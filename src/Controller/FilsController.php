<?php

namespace App\Controller;

use App\Entity\Fils;
use App\Form\FilsType;
use App\Repository\FilsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/fils')]
final class FilsController extends AbstractController{
    #[Route(name: 'app_fils_index', methods: ['GET'])]
    public function index(FilsRepository $filsRepository): Response
    {
        return $this->render('fils/index.html.twig', [
            'fils' => $filsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fils_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fil = new Fils();
        $form = $this->createForm(FilsType::class, $fil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fil);
            $entityManager->flush();

            return $this->redirectToRoute('app_fils_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fils/new.html.twig', [
            'fil' => $fil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fils_show', methods: ['GET'])]
    public function show(Fils $fil): Response
    {
        return $this->render('fils/show.html.twig', [
            'fil' => $fil,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fils_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fils $fil, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FilsType::class, $fil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fils_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fils/edit.html.twig', [
            'fil' => $fil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fils_delete', methods: ['POST'])]
    public function delete(Request $request, Fils $fil, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fil->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($fil);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_fils_index', [], Response::HTTP_SEE_OTHER);
    }
}
