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
            $school->setLogo('https://via.placeholder.com/150')
                ->setSchoolName($name)
                ->setSlug($this->slugify->generate($name))
                ->setSchoolCode('0441442D')
                ->setSchoolDesc('Texte de présentation de la formation')
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
