<?php

namespace App\DataFixtures;

use App\Entity\Student;
use App\Services\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StudentFixtures extends Fixture implements DependentFixtureInterface
{
    private Slugify $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        $maxValue = 5;
        for ($i = 0; $i < $maxValue; $i++) {
            $student = new Student();
            $student->setPicture('https://picsum.photos/400/400')
                    ->setIne('12345678910')
                    ->setSchool($this->getReference('school_' . $i))
                    ->setUser($this->getReference('ROLE_STUDENT_COMPLETED_' . $i))
                    ->setSlug($this->getReference('ROLE_STUDENT_COMPLETED_' . $i)->getFirstname() . '-' .
                    $this->getReference('ROLE_STUDENT_COMPLETED_' . $i)->getLastname());
            $this->addReference('student_' . $i, $student);
            $manager->persist($student);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SchoolFixtures::class,
            UserFixtures::class
        ];
    }
}
