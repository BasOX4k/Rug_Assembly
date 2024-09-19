<?php

namespace App\Controller;

use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BoutiqueController extends AbstractController
{
    #[Route('/boutique', name: 'app_boutique')]

    public function index(ProduitsRepository $produitsRepository): Response
    {
        return $this->render('client/boutique/index.html.twig', [
            'controller_name' => 'BoutiqueController',
            'produits' => $produitsRepository->findAll(),
            
        ]);
    }
}