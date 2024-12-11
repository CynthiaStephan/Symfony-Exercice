<?php

namespace App\DataFixtures;

use App\Entity\Cat;
use App\Entity\House;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture{
    public function load(ObjectManager $manager): void {
        $faker = Factory::create('fr-FR');
        for ($i = 0; $i < 10; $i++){
            $houseId = $manager->getRepository(House::class)->findAll();
            $catId = $manager->getRepository(Cat::class)->findAll();
            $user = new User();
            
            $user->setFirstName($faker->name());
            $user->setLastName(($faker->name()));
            $user->setAge($faker->numberBetween(18, 99));
            $user->setGender($faker->randomElement(['woman', 'man', 'other']));
            $user->setHouse($faker->randomElement($houseId));
            $user->addCat($faker->randomElement($catId));

            $manager->persist($user);
        }
        $manager->flush();
    }
}