<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Recettes;
use App\Repository\UserRepository;
use App\Repository\RecettesRepository;
use App\Repository\RecetteLikeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(RecettesRepository $recettesRepository): Response
    {
        $rct = $recettesRepository->findAll();
        shuffle($rct);

        if (isset($rct))
        {
            $recR = $rct[0];
        }
        else {
            $recR = null;
        }


        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'recette'=> $recR,
        ]);
    }

    #[Route('/cookie-other', name: 'app_infos')]
    public function infos(): Response
    {
        return $this->render('main/info.html.twig', []);
    }
}
