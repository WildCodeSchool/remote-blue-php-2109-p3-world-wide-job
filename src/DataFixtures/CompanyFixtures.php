<?php

namespace App\DataFixtures;

use App\Entity\Company;
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

    public function load(ObjectManager $manager): void
    {
        foreach (self::COMPANY as $key => $name) {
            $company = new Company();
            $company->setLogo('https://via.placeholder.com/150')
                ->setCompanyName($name)
                ->setCompanyFormat('SARL')
                ->setSiret('12345678900013')
                ->setSiren('123456789')
                ->setDescription('Ceci est une déscription test')
                ->setUser($this->getReference('user_' . $key));
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
