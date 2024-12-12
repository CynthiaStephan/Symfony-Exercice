<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PeopleCatsController extends AbstractController
{
    #[Route('/cats', name: 'app_people_cats')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        $catOwner = [];
        
        foreach ($users as $user) {
            $cats = $user->getCats();
            if(!$cats->isEmpty()) {
                $name = $user->getFirstName();
                $catNames = [];      
            }

            foreach ($cats as $cat) {
                $catNames[] = $cat->getName();
            }
            $catOwner[] = ['name' => $name, 'catNames' => $catNames];
        }

        return $this->render('people_cats/people_cats.html.twig', ['catOwner' => $catOwner]);
    }
}
