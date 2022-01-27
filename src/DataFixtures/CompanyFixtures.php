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
                ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
                ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
                ->setUser($this->getReference('ROLE_COMPANY_COMPLETED_' . $key))
                ->setStatus(true);
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
