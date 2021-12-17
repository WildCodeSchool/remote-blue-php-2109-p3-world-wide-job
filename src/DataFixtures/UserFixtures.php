<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const USERROLES = [
        'ROLE_COMPANY',
        'ROLE_SCHOOL',
        'ROLE_STUDENT',
    ];

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $counter = 0;
        foreach (self::USERROLES as $role) {
            $maxUser = 4;
            for ($i = 0; $i <= $maxUser; $i++) {
                $counter++;
                $user = new User();
                $user->setEmail('jean.dupont' . $counter . '@gmail.com');
                $hashedPassword = $this->passwordHasher->hashPassword(
                    $user,
                    'companyPassword'
                );
                $user->setPassword($hashedPassword)
                    ->setRoles([$role])
                    ->setCivility('Monsieur')
                    ->setFirstName('Jean')
                    ->setLastname('Dupont')
                    ->setBirthdate(new DateTime('2002-10-12'))
                    ->setPhone(0665575533)
                    ->setAdress1('333 rue de la gerla')
                    ->setAdress2('bis terrain du moulin')
                    ->setCity('Saint Siméon de Bressieux')
                    ->setZip(38870)
                    ->setCountry('France');
                $this->addReference($role . '_' . $i, $user);
                $manager->persist($user);
            };
        };
        $manager->flush();
    }
}
