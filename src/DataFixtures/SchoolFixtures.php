<?php

namespace App\DataFixtures;

use App\Entity\School;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SchoolFixtures extends Fixture implements DependentFixtureInterface
{
    public const SCHOOL = [
        'Wild Code School',
        'HEC',
        'Université de Lille',
        'IUT Nantes',
        'BTS MUC',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SCHOOL as $key => $name) {
            $school = new School();
            $school->setLogo('https://via.placeholder.com/150')
                ->setSchoolName($name)
                ->setSchoolCode('0441442D')
                ->setSchoolDesc('Texte de présentation de la formation')
                ->setType(rand(1, 9))
                ->setUser($this->getReference('ROLE_SCHOOL_' . $key));
            $this->addReference('school_' . $key, $school);
            $manager->persist($school);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
