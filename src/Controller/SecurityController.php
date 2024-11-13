<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


use Symfony\Component\HttpFoundation\Request;


class SecurityController extends AbstractController
{

    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Si l'utilisateur est déjà authentifié
        if ($this->getUser()) {
            // Ajouter un message flash
            $this->addFlash('info', 'Vous êtes déjà connecté.');

            // Rediriger vers une autre page, par exemple le tableau de bord
            return $this->redirectToRoute('register_benevole'); // Remplacez 'dashboard' par la route souhaitée
        }

        // Récupérer les erreurs d'authentification
        $error = $authenticationUtils->getLastAuthenticationError();

        // Dernier email saisi
        $lastEmail = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_email' => $lastEmail,
            'error' => $error,
        ]);
    }
}
