<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'app_about')]
    public function index(): Response
    {
        $teamMembers = [
            ['name' => 'John Doe', 'role' => 'Lead Developer', 'bio' => 'John est un développeur expérimenté avec une passion pour les chats'],
            ['name' => 'Jane Smith', 'role' => 'Designer', 'bio' => 'Jane est une designer créative'],
            ['name' => 'Patrick Jaques', 'role' => 'Project Manager', 'bio' => 'Patrick gère une équipe et les apéros'],
        ];
        return $this->render('about/about.html.twig', [
            'controller_name' => 'AboutController',
            'team_members' => $teamMembers,
        ]);
    }
}
