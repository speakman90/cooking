<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recettes', name: 'recettes_')]
class RecettesController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(RecetteRepository $recetteRepository): Response
    {
        return $this->render('recettes/index.html.twig',[
            'recette' => $recetteRepository->findBy([],['title' => 'ASC']),
        ]);
    }

    #[Route('/{id}', name: 'details')]
    public function details(Recette $recette): Response
    {
        return $this->render('recettes/detail.html.twig', compact('recette'));
    }
}
