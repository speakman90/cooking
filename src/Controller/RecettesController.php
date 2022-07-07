<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Recettes;
use App\Form\RecettesType;
use App\Entity\RecetteLike;
use App\Repository\RecettesRepository;
use App\Repository\RecetteLikeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/recettes')]
class RecettesController extends AbstractController
{
    #[Route('/', name: 'app_recettes_index', methods: ['GET'])]
    public function index(RecettesRepository $recettesRepository): Response
    {
        return $this->render('recettes/index.html.twig', [
            'recettes' => $recettesRepository->findAll(),
        ]);
    }

    #[Route('/profile/new', name: 'app_recettes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RecettesRepository $recettesRepository, SluggerInterface $slugger): Response
    {
        $recette = new Recettes();
        $recette->setUser($this->getUser());
        $form = $this->createForm(RecettesType::class, $recette);
        $form->handleRequest($request);

        

        if ($form->isSubmitted() && $form->isValid()) {
            
            $imgFile = $form->get('image')->getData();
            $originalFile = pathinfo($imgFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFile);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $imgFile->guessExtension();
            $imgFile->move($this->getParameter('images_directory'), $newFilename);
            $recette->setImage($newFilename);

            $recettesRepository->add($recette, true);

            return $this->redirectToRoute('app_recettes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recettes/new.html.twig', [
            'recette' => $recette,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recettes_show', methods: ['GET'])]
    public function show(Recettes $recette): Response
    {

        $user = $recette->getUser();

        return $this->render('recettes/show.html.twig', [
            'recette' => $recette,
            'user' => $user,

        ]);
    }

    #[Route('/{id}/profile/edit', name: 'app_recettes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recettes $recette, RecettesRepository $recettesRepository): Response
    {
        $form = $this->createForm(RecettesType::class, $recette);
        $form->handleRequest($request);

        $user = $recette->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $recettesRepository->add($recette, true);

            return $this->redirectToRoute('app_recettes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recettes/edit.html.twig', [
            'recette' => $recette,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_recettes_delete', methods: ['POST'])]
    public function delete(Request $request, Recettes $recette, RecettesRepository $recettesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recette->getId(), $request->request->get('_token'))) {
            $recettesRepository->remove($recette, true);
        }

        return $this->redirectToRoute('app_recettes_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/like', name: 'app_recettes_like')]
    public function like(Recettes $recettes, RecetteLikeRepository $recetteLikeRepository): Response 
    {
        $user = $this->getUser();

        if(!$user)
        {
            return $this->json([
                'code' => 403,
                'message' => 'Connexion obligatoire'
            ], 403);
        }

        if($recettes->isLikedByUser($user))
        {
            $like = $recetteLikeRepository->findOneBy([
                'recette' => $recettes,
                'user' => $user
            ]);

            $recetteLikeRepository->remove($like, true);

            return $this->json([
                'code' => 200,
                'message' => 'Like supprimée',
                'likes' => $recetteLikeRepository->count(['recette'=>$recettes])
            ], 200);
        }

        $like = new RecetteLike();
        $like->setRecette($recettes)
             ->setUser($user);

        $recetteLikeRepository->add($like, true);

        return $this->json(['code'=> 200, 'message'=> 'Like ok', 'likes' => $recetteLikeRepository->count(['recette'=>$recettes])], 200);        
    }
}
