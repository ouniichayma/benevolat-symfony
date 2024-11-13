<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AssociationRegistrationController extends AbstractController
{
    #[Route('/association/registration', name: 'app_association_registration')]
    public function index(): Response
    {
        return $this->render('association_registration/index.html.twig', [
            'controller_name' => 'AssociationRegistrationController',
        ]);
    }
}
