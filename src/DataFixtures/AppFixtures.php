<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprises;
use App\Entity\Formations;
use App\Entity\Stages;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        for($i=0; $i <= 50; $i++)
        {
            $entreprise = new Entreprises();

            $entreprise->setNom($faker->company);

            $entreprise->setAdresse($faker->address);

            $entreprise->setLienInternet($faker->url);

            $entreprise->setActivite($faker->catchPhrase);

            $entreprises[] = $entreprise;

            $manager->persist($entreprise);
        }
        $formations = array("DUT","Licence Professionelle Programation Avancée","Licence Professionelle Numérique");

        foreach($formations as $nom)
        {
            $formation = new Formations();
            $formation->setNom($nom);

            for($i=0; $i <= 50; $i++)
            {
                $stages = new Stages();

                $stages->setTitre($faker->jobTitle);

                $stages->setDescMission($faker->realText($maxNbChars = 200, $indexSize = 2));

                $stages->setEmail($faker->email);

                $stages->addFormation($formation);

                $numEntreprise = $faker->numberBetween($min =0,$max=50);

                $stages->setEntreprise($entreprises[$numEntreprise]);
                $entreprises[$numEntreprise]->addStage($stages);

                $manager->persist($entreprises[$numEntreprise]);

                $manager->persist($stages);
            }
            $manager->persist($formation);
        }
        $manager->flush();
    }
}
