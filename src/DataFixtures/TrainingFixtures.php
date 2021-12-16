<?php

namespace App\DataFixtures;

use App\Entity\Training;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TrainingFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $maxCurriculum = 5;
        for ($i = 0; $i < $maxCurriculum; $i++) {
            $maxTraining = 2;
            for ($itterator = 0; $itterator < $maxTraining; $itterator++) {
                $training = new Training();
                $training->setCurriculum($this->getReference('curriculum_' . $itterator))
                    ->setFieldOfStudy('Economie')
                    ->setSchool('Ecole de commerce de Nantes')
                    ->setDegree('Master')
                    ->setGraduate(true)
                    ->setDateIn(new DateTime('20016-10-12'))
                    ->setDateOut(new DateTime('2019-10-12'))
                    ->setDescription('Aut dolorem repudiandae ut odio ut sint officia eos officia quia est 
                    provident minima quo dolores eius. Et quam modi aut eaque saepe est aliquid cumque a libero 
                    molestias non minus veniam.');
                $manager->persist($training);
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CurriculumFixtures::class
        ];
    }
}
