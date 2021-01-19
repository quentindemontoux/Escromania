<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController'
        ]);
    }

    /**
     * @Route("/users/profile", name="profile")
     */
    public function profile(): Response
    {
        return $this->render('app/profile.html.twig', [
            'controller_name' => 'AppController'
        ]);
    }

    /**
     * @Route("/users/profile/{id}", name="edit_profile")
     */
    public function edit_profile(User $user, Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder): Response
    {

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute("profile");
        }

        return $this->render('app/edit_profile.html.twig', [
            'user' => $user,
            "editForm" => $form->createView()
        ]);
    }

    /**
     * @Route("/users/games", name="games")
     */
    public function games(GameRepository $repository): Response
    {
        $games = $repository->findAll();
        return $this->render('app/games.html.twig', [
            'games' => $games
        ]);
    }

    /**
     * @Route("/users/games/id/{id}", name="game_details")
     */
    public function game_details(Game $game): Response
    {
        return $this->render('app/game_details.html.twig', [
            'game' => $game
        ]);
    }

    /**
     * @Route("/users/games/search", name="search")
     */
    public function search(): Response
    {
        return $this->render('app/search.html.twig', [
            'controller_name' => 'AppController'
        ]);
    }

}
