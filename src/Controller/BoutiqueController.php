<?php

namespace App\Controller;

use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
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

    
    /**
 * @Route("/product/{id}", name="product_detail")
 */
#[Route('/boutique/detail/{id}', name: 'boutique_detail')]
public function boutiqueDetail(ProduitsRepository $produitsRepository, int $id): Response
{
    $produit = $produitsRepository->findOneBy(['id' => $id]);

    return $this->render('client/boutique/detail.html.twig', [
        'controller_name' => 'BoutiqueController',
        'produit' => $produit,
    ]);
}
#[Route('/boutique/search', name: 'boutique_search', methods: ['GET'])]
    public function search(HttpFoundationRequest $request, ProduitsRepository $produitsRepository): Response
    {
        $searchTerm = $request->query->get('q'); // On récupère le terme de recherche "q"
        $produits = $produitsRepository->findByName($searchTerm); // On utilise la méthode du repository

        return $this->render('client/boutique/index.html.twig', [
            'controller_name' => 'BoutiqueController',
            'produits' => $produits,
        ]);
    }

}