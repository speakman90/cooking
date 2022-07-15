<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Recettes;
use App\Form\UserMdpType;
use App\Form\UserCrudType;
use App\Repository\UserRepository;
use App\Repository\RecettesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('profile/account', name: 'app_account_')]
class AccountController extends AbstractController
{
    #[Route('/{id}', name: 'index')]
    public function index(User $user): Response
    {
        $username = $user->getUsername();
        $recettes = $user->getRecettes();


        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
            'recettes' => $recettes,
            'username'=> $username
        ]);
    }

    #[Route('/{id}/infos/', name: 'account-crud', methods: ['GET', 'POST'])]
    public function crud(Request $request, User $user, UserRepository $userRepository, SluggerInterface $slugger): Response
    {

        $form = $this->createForm(UserCrudType::class, $user);
        $formMdp = $this->createForm(UserMdpType::class, $user);
        $form->handleRequest($request);
        $formMdp->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('avatar')->getData() == null) {

                $username = $form->get('username')->getData();
                $user->setUsername($username);

                $userRepository->add($user, true);

                return $this->redirectToRoute('app_account_index', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
            }
            else {
                $imgFile = $form->get('avatar')->getData();
                $originalFile = pathinfo($imgFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFile);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imgFile->guessExtension();
                $imgFile->move($this->getParameter('avatar_directory'), $newFilename);
                $user->setAvatar($newFilename);

                $userRepository->add($user, true);

                return $this->redirectToRoute('app_account_index', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
            }

        }

        return $this->renderForm('account/crud.html.twig', [
            'form' => $form,
            'user' => $user,
            'formMdp' => $formMdp,
        ]);
    }
}
