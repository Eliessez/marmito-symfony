<?php

namespace App\DataFixtures;

use App\Entity\Recette;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;

class RecetteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        $slugger = new AsciiSlugger();
        $faker->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($faker));

        for ($i=0; $i < 25; $i++) {

            $recette = new Recette();
            $recette
            ->setNom($faker->foodName())
            ->setNombrePersonne($faker->randomNumber(2,false))
            ->setPrix($faker->randomDigit())
            ->setDifficult($faker->randomDigitNotNull())
            ->setFavoris($faker->boolean)
            ->setCreatedAt(new DateTimeImmutable())
            ->setUpdateAt(new DateTimeImmutable())
            ->setListe($faker->beverageName())
            ->setTime($faker->randomNumber(3, false))
            ->setSlug($slugger->slug($recette->getNom())->lower());
            $manager->persist($recette);
        }

        $manager->flush();
    }
}
