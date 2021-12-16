<?php

namespace App\DataFixtures;

use App\Entity\Degree;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DegreeFixtures extends Fixture implements DependentFixtureInterface
{
    public const DEGREE = [
        'DEGEAD',
        'L3 économie',
        'Master Achats',
        'Master Communication',
        'Licence LEA',
    ];

    public function load(ObjectManager $manager): void
    {
        $maxSchool = 5;
        for ($i = 0; $i < $maxSchool; $i++) {
            foreach (self::DEGREE as $key => $name) {
                $degree = new Degree();
                $degree->setSchool($this->getReference('school_' . $i))
                    ->setDegre($name)
                    ->addStudent($this->getReference('student_' . $key));
                $manager->persist($degree);
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SchoolFixtures::class,
            StudentFixtures::class
        ];
    }
}
