<?php

namespace App\DataFixtures;

use App\Entity\School;
use App\Services\Slugify;
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

    private Slugify $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::SCHOOL as $key => $name) {
            $school = new School();
            $school->setLogo('profile.png')
                ->setSchoolName($name)
                ->setSlug($this->slugify->generate($name))
                ->setSchoolCode('0441442D')
                ->setSchoolDesc('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
                ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
                ->setType(rand(1, 9))
                ->setUser($this->getReference('ROLE_SCHOOL_COMPLETED_' . $key));
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
