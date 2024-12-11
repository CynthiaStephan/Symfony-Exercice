<?php

namespace App\Controller;

use App\Repository\CatRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PeopleCatsController extends AbstractController
{
    #[Route('/cats', name: 'app_people_cats')]
    public function index(UserRepository $userRepository, CatRepository $catRepository): Response
    {
        $users = $userRepository->findAll();
        $cats = $catRepository->findAll();
        dump($cats);
        dump($users);

        return $this->render('people_cats/people_cats.html.twig', [
            'users'=> $users,
            'cats'=> $cats,
        ]);
    }
}
