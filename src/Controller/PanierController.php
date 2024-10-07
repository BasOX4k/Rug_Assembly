<?php
namespace App\Controller;

use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierController extends AbstractController
{
    #[Route('/boutique', name: 'app_boutique')]
    public function index(ProduitsRepository $produitsRepository): Response
    {
        return $this->render('client/boutique/index.html.twig', [
            'controller_name' => 'BoutiqueController',
            'produits' => $produitsRepository->findAll(),
        ]);
    }

    #[Route('/boutique/detail/{id}', name: 'boutique_detail')]
    public function boutiqueDetail(ProduitsRepository $produitsRepository, int $id): Response
    {
        $produit = $produitsRepository->findOneBy(['id' => $id]);

        return $this->render('client/boutique/detail.html.twig', [
            'controller_name' => 'BoutiqueController',
            'produit' => $produit,
        ]);
    }

    #[Route('/panier', name: 'panier')]
    public function panier(SessionInterface $session, ProduitsRepository $produitsRepository): Response
    {
        $panier = $session->get('panier', []);

        $panierWithData = [];
        $total = 0;

        foreach ($panier as $id => $quantity) {
            $produit = $produitsRepository->find($id);
            $panierWithData[] = [
                'produit' => $produit,
                'quantity' => $quantity,
            ];
            $total += $produit->getPrix() * $quantity;
        }

        return $this->render('client/panier/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total,
        ]);
    }

    #[Route('/panier/ajout/{id}', name: 'ajout_panier')]
    public function ajoutPanier($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('panier');
    }

    #[Route('/panier/supprimer/{id}', name: 'supprimer_panier')]
    public function supprimerDuPanier($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('panier');
    }
}
