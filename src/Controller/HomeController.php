<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('client/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
    // #[Route('/boutique', name: 'app_boutique')]

    // public function boutique(): Response
    // {
    //     return $this->render('client/boutique/index.html.twig', [
    //         'controller_name' => 'BoutiqueController',
    //     ]);
    // }
}
