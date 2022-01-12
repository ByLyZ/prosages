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

        $FormationDUT = new Formations();
        $FormationDUT->setNom("DUT");
        $manager->persist($FormationDUT);

        $FormationLPProg = new Formations();
        $FormationLPProg->setNom("Licence Professionelle Programation Avancée");
        $manager->persist($FormationLPProg);

        $FormationLPNum = new Formations();
        $FormationLPNum->setNom("Licence Professionelle Numérique");
        $manager->persist($FormationLPNum);

        $tabFormations = array($FormationDUT, $FormationLPProg, $FormationLPNum);
        foreach($tabFormations as $typeFormation){
            $manager->persist($typeFormation);
        }

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

        for($i=0; $i <= 50; $i++)
        {
            $stages = new Stages();

            $stages->setTitre($faker->jobTitle);

            $stages->setDescMission($faker->realText($maxNbChars = 200, $indexSize = 2));

            $stages->setEmail($faker->email);

            $stages->setEntreprise();

            $manager->persist($stages);
        }

        $manager->flush();
    }
}
