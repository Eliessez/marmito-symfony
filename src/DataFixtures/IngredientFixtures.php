<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        for ($i=0; $i < 100; $i++) {
            $ingredient=new Ingredient ();
            $ingredient->setNom($faker->name())
            ->setPrix($faker->randomFloat(2,0,10))
            ->setCreateAt(new DateTimeImmutable());
            $manager->persist($ingredient);
        }

        $manager->flush();

    }
}
