<?php

namespace App\Controller;

use App\Entity\Accessoires;
use App\Form\AccessoiresType;
use App\Repository\AccessoiresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/accessoires')]
final class AccessoiresController extends AbstractController{
    #[Route(name: 'app_accessoires_index', methods: ['GET'])]
    public function index(AccessoiresRepository $accessoiresRepository): Response
    {
        return $this->render('accessoires/index.html.twig', [
            'accessoires' => $accessoiresRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_accessoires_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $accessoire = new Accessoires();
        $form = $this->createForm(AccessoiresType::class, $accessoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($accessoire);
            $entityManager->flush();

            return $this->redirectToRoute('app_accessoires_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('accessoires/new.html.twig', [
            'accessoire' => $accessoire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_accessoires_show', methods: ['GET'])]
    public function show(Accessoires $accessoire): Response
    {
        return $this->render('accessoires/show.html.twig', [
            'accessoire' => $accessoire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_accessoires_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Accessoires $accessoire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AccessoiresType::class, $accessoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_accessoires_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('accessoires/edit.html.twig', [
            'accessoire' => $accessoire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_accessoires_delete', methods: ['POST'])]
    public function delete(Request $request, Accessoires $accessoire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accessoire->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($accessoire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_accessoires_index', [], Response::HTTP_SEE_OTHER);
    }
}
