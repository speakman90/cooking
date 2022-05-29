<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recettes', name: 'recettes_')]
class RecettesController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(RecetteRepository $recetteRepository, Request $request): Response
    {
        $limit = 5;

        $page = (int)$request->query->get('page', 1);

        $recettes = $recetteRepository->getPaginateRecettes($page, $limit);

        $total = $recetteRepository->getTotalRecettes();

        return $this->render('recettes/index.html.twig',compact('recettes', 'total', 'limit', 'page'));
    }

    #[Route('/{id}', name: 'details')]
    public function details(Recette $recette): Response
    {
        return $this->render('recettes/detail.html.twig', compact('recette'));
    }
}
