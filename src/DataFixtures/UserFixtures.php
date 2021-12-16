<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public const NAME = [
        'Dupont',
        'Dubois',
        'Du moulin',
        'Le blanc',
        'Constant',
    ];

    public const MAXROLE = 2;

    public function load(ObjectManager $manager): void
    {
        foreach (self::NAME as $key => $name) {
            $user = new User();
            $user->setMail('jean.dupont@gmail.com')
                ->setPassword('password')
                ->setCivility('Monsieur')
                ->setFirstName('Jean')
                ->setLastname($name)
                ->setBirthdate(new DateTime('2008-10-12'))
                ->setPhone(0665575533)
                ->setAdress1('333 rue de la gerla')
                ->setAdress2('bis terrain du moulin')
                ->setCity('Saint Siméon de Bressieux')
                ->setZip(38870)
                ->setCountry('France')
                ->setRole(($key <= self::MAXROLE && $key >= 0) ? ($key + 1) : rand(1, 3));
            $manager->persist($user);
            $this->addReference('user_' . $key, $user);
        }

        $manager->flush();
    }
}
