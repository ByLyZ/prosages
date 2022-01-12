<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Formations;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $FormationDUT = new Formations();
        $FormationDUT->setNom("DUT");
        $manager->persist($FormationDUT);

        $manager->flush();
    }
}
