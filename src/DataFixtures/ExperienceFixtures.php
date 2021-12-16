<?php

namespace App\DataFixtures;

use App\Entity\Experience;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ExperienceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $maxCurriculum = 5;
        for ($i = 0; $i < $maxCurriculum; $i++) {
            $maxExperience = 2;
            for ($itterator = 0; $itterator <= $maxExperience; $itterator++) {
                $experience = new Experience();
                $experience->setCurriculum($this->getReference('curriculum_' . $i))
                    ->setCompany('Airbus')
                    ->setLocalisation('Toulouse')
                    ->setContractType(rand(1, 3))
                    ->setDateIn(new DateTime('20016-10-12'))
                    ->setDateOut(new DateTime('2019-10-12'))
                    ->setDescription('Aut dolorem repudiandae ut odio ut sint officia eos officia quia est 
                    provident minima quo dolores eius. Et quam modi aut eaque saepe est aliquid cumque a libero 
                    molestias non minus veniam.');
                $manager->persist($experience);
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
