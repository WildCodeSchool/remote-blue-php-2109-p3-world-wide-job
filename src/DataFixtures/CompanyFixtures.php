<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Services\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends Fixture implements DependentFixtureInterface
{
    public const COMPANY = [
        'LVMH',
        'Dassault',
        'Sogid',
        'Macif',
        'Fresenius Kabi',
    ];

    private Slugify $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::COMPANY as $key => $name) {
            $company = new Company();
            $company->setLogo('profile.png')
                ->setCompanyName($name)
                ->setSlug($this->slugify->generate($name))
                ->setCompanyFormat('SARL')
                ->setSiret('12345678900013')
                ->setSiren('123456789')
                ->setDescription('Ceci est une déscription test')
                ->setUser($this->getReference('ROLE_COMPANY_' . $key));
            $this->addReference('company_' . $key, $company);
            $manager->persist($company);
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
