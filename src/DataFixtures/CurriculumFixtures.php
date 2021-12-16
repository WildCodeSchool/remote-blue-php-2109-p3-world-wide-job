<?php

namespace App\DataFixtures;

use App\Entity\Curriculum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CurriculumFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $maxCurriculum = 5;
        for ($i = 0; $i < $maxCurriculum; $i++) {
            $curriculum = new Curriculum();
            $curriculum->setPicture('https://picsum.photos/300/300')
                ->setSkills("Je suis motivé et perfectionniste")
                ->setLanguage('English')
                ->setDrivingLicence(true)
                ->setStudent($this->getReference('student_' . $i));
            $this->addReference('curriculum_' . $i, $curriculum);
            $manager->persist($curriculum);
        };
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            StudentFixtures::class
        ];
    }
}
