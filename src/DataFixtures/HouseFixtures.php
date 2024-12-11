<?php

namespace App\DataFixtures;

use App\Entity\House;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class HouseFixtures extends Fixture{
    public function load(ObjectManager $manager): void {
        $faker = Factory::create('fr-FR');
        for ($i = 0; $i < 7; $i++){

            $house = new House();

            $house->setAdress($faker->address);
            $manager->persist($house);
        }

        $manager->flush();
    }
}