<?php

namespace App\Controller;

use App\Entity\Recettes;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;

#[Route('/recettes', name: 'app_recettes')]
class RecettesController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(RecetteRepository $recetteRepository, Request $request): Response
    {
        $limit = 5;

        $page = (int)$request->query->get('page', 1);

        $search = $request->request->get('search');

        $recettes = $recetteRepository->getPaginateRecettes($page, $limit, $search);

        $total = $recetteRepository->getTotalRecettes($search);

        return $this->render('recettes/index.html.twig',compact('recettes', 'total', 'limit', 'page', 'search'));
    }

    #[Route('/{slug}', name: 'details')]
    public function details(Recettes $recette): Response
    {
        return $this->render('recettes/detail.html.twig', compact('recette'));
    }
}
