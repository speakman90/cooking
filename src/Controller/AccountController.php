<?php

namespace App\Controller;

use App\Entity\Recettes;
use App\Entity\User;
use App\Repository\RecettesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('profile/account', name: 'app_account_')]
class AccountController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ManagerRegistry $doctrine ): Response
    {
        $username = $_SESSION['_sf2_attributes']['_security.last_username'];
        $userId = $doctrine->getRepository(User::class)->findby(['username'=>$username]);
        $recettes = $userId[0]->getRecettes();


        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
            'recettes' => $recettes
        ]);
    }
}
