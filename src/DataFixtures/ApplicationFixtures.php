<?php

namespace App\DataFixtures;

use App\Entity\Application;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ApplicationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $maxOffer = 5;
        for ($i = 0; $i < $maxOffer; $i++) {
            for ($j = 0; $j < $maxOffer; $j++) {
                $application = new Application();
                $application->setStatus(rand(1, 3))
                    ->setStudent($this->getReference('student_' . $i))
                    ->setOffer($this->getReference('offer_' . $j));
                $manager->persist($application);
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            StudentFixtures::class,
            OfferFixtures::class
        ];
    }
}
