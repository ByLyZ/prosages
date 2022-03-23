<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprises;
use App\Entity\Formations;
use App\Entity\Stages;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $admin = new User();
        $admin->setUsername('admin');
        $admin->setRoles(['ROLE_ADMIN','ROLE_USER']);
        $admin->setPassword('$2y$10$L.y6/zEapaSDUXaJZt4uX.Yyu2sGGjw2sh31CjN4QdCJZsbtGhfg2');
        $manager->persist($admin);

        $user = new User();
        $user->setUsername('user');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword('$2y$10$09XoCEO.7Rk4yuQtw4GtcuPKqZyGbvEvrub0cuJGbWr1YFYiKYjJ2');
        $manager->persist($user);

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
