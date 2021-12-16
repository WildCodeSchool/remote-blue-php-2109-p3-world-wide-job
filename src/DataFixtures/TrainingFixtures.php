<?php

namespace App\DataFixtures;

use App\Entity\Training;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TrainingFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $training = new Training();
        $training->

        $manager->flush();
    }
}
