<?php

namespace App\Controller;

use App\Entity\Tapis;
use App\Form\TapisType;
use App\Repository\TapisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/tapis')]
#[IsGranted('ROLE_ADMIN')]
final class TapisController extends AbstractController{
    #[Route(name: 'app_tapis_index', methods: ['GET'])]
    public function index(TapisRepository $tapisRepository): Response
    {
        return $this->render('tapis/index.html.twig', [
            'tapis' => $tapisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tapis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tapi = new Tapis();
        $form = $this->createForm(TapisType::class, $tapi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tapi);
            $entityManager->flush();

            return $this->redirectToRoute('app_tapis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tapis/new.html.twig', [
            'tapi' => $tapi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tapis_show', methods: ['GET'])]
    public function show(Tapis $tapi): Response
    {
        return $this->render('tapis/show.html.twig', [
            'tapi' => $tapi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tapis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tapis $tapi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TapisType::class, $tapi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tapis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tapis/edit.html.twig', [
            'tapi' => $tapi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tapis_delete', methods: ['POST'])]
    public function delete(Request $request, Tapis $tapi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tapi->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tapi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tapis_index', [], Response::HTTP_SEE_OTHER);
    }
}
