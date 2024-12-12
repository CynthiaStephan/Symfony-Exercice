<?php

namespace App\Controller;

use App\Repository\HouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HouseController extends AbstractController
{
    #[Route('/house', name: 'app_house')]
    public function index(HouseRepository $houseRepository): Response
    {
        $houses = $houseRepository->findAll();

        $directory = [];

        foreach ($houses as $house) {
            $adress = $house->getAdress();
            $resident = $house->getUsers();

            if(!$resident->isEmpty()) {
                $residentName = [];
                foreach ($resident as $user) {
                    $residentName[] = $user->getFirstName();
                }
                dump($residentName);
            }

            $directory[] = ['resident' => $resident, 'adress' => $adress];
        }

        return $this->render('house/house.html.twig', [
            'directory' => $directory,
        ]);
    }
}
