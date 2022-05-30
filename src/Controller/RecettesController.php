<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/recettes', name: 'recettes_')]
class RecettesController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(RecetteRepository $recetteRepository, Request $request, ManagerRegistry $doctrine): Response
    {
        $limit = 5;

        $page = (int)$request->query->get('page', 1);

        $search = $request->request->get('search');

        if($request->query->get('ajax')){
            return new JsonResponse([
                'content' => $this->render('recettes/index.html.twig',compact('recettes', 'total', 'limit', 'page'))
            ]);
        }

        $recettes = $recetteRepository->getPaginateRecettes($page, $limit, $search);

        $total = $recetteRepository->getTotalRecettes($search);

        $recette = new Recette();
        $form = $this->createForm(RecetteType::class, $recette);

        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $doctrine->getManager();
            $em->persist($recette);
            $em->flush();

        }

        return $this->render('recettes/index.html.twig',['recettes'=>$recettes, 'total'=>$total, 'limit'=>$limit, 'page'=>$page, 'search'=>$search, 'form'=>$form->createView()]);
    }

    #[Route('/ajax/{id}', name: 'add')]
    public function addRecette(string $id, string $title, string $content, string $img, EntityManagerInterface $em): Response
    {
        $recette = new Recette();
        $recette->setId($id);
        $recette->setTitle($title);
        $recette->setContent($content);
        $recette->setImg($img);
        $em->persist($recette);
        $em->flush();
        return new JsonResponse(['recette'=>$recette]);
    }

    #[Route('/{id}', name: 'details')]
    public function details(Recette $recette): Response
    {
        return $this->render('recettes/detail.html.twig', compact('recette'));
    }
}
