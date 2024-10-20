<?php
namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;

class CommandeController extends AbstractController
{
    #[Route('client/commande', name: 'passer_commande')]
    public function commande(SessionInterface $session, ProduitsRepository $produitsRepository, Request $request, EntityManagerInterface $entityManager): Response
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

        // Crée un nouvel objet Commande
        $commande = new Commande();

        // Crée le formulaire
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistre la commande dans la base de données
            $commande->setTotal($total);
            $commande->setDate(new \DateTime());

            // Ajoute les produits à la commande
            foreach ($panierWithData as $item) {
                $commande->addProduit($item['produit']); // Ajoute le produit à la commande
            }

            $entityManager->persist($commande);
            $entityManager->flush();

            // Vider le panier après la commande
            $session->remove('panier');

            // Rediriger vers une page de confirmation ou d'accueil
            return $this->redirectToRoute('confirmation_commande');
        }

        return $this->render('client/commande/commande.html.twig', [
            'form' => $form->createView(),
            'items' => $panierWithData,
            'total' => $total,
        ]);
    }

    #[Route('client/commande/confirmation', name: 'confirmation_commande')]
    public function confirmation(): Response
    {
        return $this->render('client/commande/confirmation.html.twig');
    }
}
