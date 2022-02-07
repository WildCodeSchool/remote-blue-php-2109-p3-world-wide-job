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
        $maxValue = 30;
        for ($i = 0; $i < $maxValue; $i++) {
            $student = new Student();
            $student->setPicture('profile.png')
                ->setIne('12345678910')
                ->setSchool($this->getReference('school_' . rand(0, 4)))
                ->setUser($this->getReference('ROLE_STUDENT_COMPLETED_' . $i))
                ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
                ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
                ->setUsername('myusername' . $i)
                ->setSlug($this->slugify->generate('myusername' . $i))
                ->setStatus(true);
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
