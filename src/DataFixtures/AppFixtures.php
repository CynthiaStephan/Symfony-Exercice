<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;



class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 1; $i <= 5; $i++){

            $article = new Article();
            $article->setTitle($faker->sentence(3));
            $article->setText($faker->paragraph(5));
            $article->setAutor($faker->name());

            $manager->persist($article);
        }

        $manager->flush();
    }
}
