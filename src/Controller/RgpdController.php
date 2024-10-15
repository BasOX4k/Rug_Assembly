<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RgpdController extends AbstractController
{
    #[Route('/rgpd', name: 'app_rgpd')]
    public function index(): Response
    {
        return $this->render('rgpd/index.html.twig', [
            'controller_name' => 'RgpdController',
        ]);
    }


    /**
     * @Route("/conditions-utilisation", name="app_conditions_utilisation")
     */
    #[Route('/rgpd/conditions_utilisation', name: 'app_rgpd_conditions_utilisation')]

    public function conditionsUtilisation(): Response
    {
        return $this->render('rgpd/conditions_utilisation.html.twig');
    }

    /**
     * @Route("/politique-confidentialite", name="app_politique_confidentialite")
     */
    #[Route('/rgpd/politique_confidentialite', name: 'app_rgpd_politique_confidentialite')]

    public function politiqueConfidentialite(): Response
    {
        return $this->render('rgpd/politique_confidentialite.html.twig');
    }
}
