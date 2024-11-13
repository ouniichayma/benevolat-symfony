<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;


use App\Entity\Benevole;
use App\Form\BenevoleType;

use Symfony\Component\HttpFoundation\Request;



class BenevolRegistrationController extends AbstractController
{
    #[Route('/benevole/register', name: 'register_benevole')]

    public function registerBenevole(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): \Symfony\Component\HttpFoundation\Response
    {


        // Création d'un nouvel objet Benevole pour le formulaire
        $benevole = new Benevole();
        $form = $this->createForm(BenevoleType::class, $benevole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword($benevole, $benevole->getMotPasse());
            $benevole->setMotPasse($hashedPassword);

            $entityManager->persist($benevole);
            $entityManager->flush();

            $this->addFlash('success', 'Inscription réussie !');
            return $this->redirectToRoute('login');  // Redirige vers la page de connexion
        }

        return $this->render('benevole_registration/index.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}
