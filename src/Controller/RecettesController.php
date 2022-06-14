<?php

namespace App\Controller;

use App\Entity\Recettes;
use App\Repository\RecettesRepository;
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
    public function index(RecettesRepository $recettesRepository, Request $request): Response
    {
        $limit = 5;

        $page = (int)$request->query->get('page', 1);

        $search = $request->request->get('search');

        $recettes = $recettesRepository->getPaginateRecettes($page, $limit, $search);

        $total = $recettesRepository->getTotalRecettes($search);

        return $this->render('recettes/index.html.twig',compact('recettes', 'total', 'limit', 'page', 'search'));
    }

    #[Route('/{slug}', name: 'details')]
    public function details(Recettes $recette): Response
    {
        dd($recette);
        return $this->render('recettes/detail.html.twig', compact('recette'));
    }
}
