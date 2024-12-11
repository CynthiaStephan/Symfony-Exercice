<?php

namespace App\DataFixtures;

use App\Entity\Cat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CatFixtures extends Fixture{
    public function load(ObjectManager $manager): void {
        $faker = Factory::create('fr-FR');
        for ($i = 0; $i < 15; $i++){

            $cat = new Cat();
            $cat->setName($faker->name);
            $cat->setAge($faker->numberBetween(0,20));
            $cat->setRace($faker->randomElement(['Persan','American shorthair','Bengal','Himalayan']));
            $cat->setColor($faker->randomElement(['Black', 'White', 'Ginger', 'Calico', 'Grey']));
            $cat->setSex($faker->randomElement(['female','male']));
            
            $manager->persist($cat);
        }

        $manager->flush();
    }
}