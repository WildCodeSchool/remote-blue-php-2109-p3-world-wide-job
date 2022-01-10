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
        ['role' => 'ROLE_COMPANY_COMPLETED', 'user' => 'company'],
        ['role' => 'ROLE_SCHOOL_COMPLETED', 'user' => 'school'],
        ['role' => 'ROLE_STUDENT_COMPLETED', 'user' => 'student']
    ];

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::USERROLES as $role) {
            $maxUser = 35;
            for ($i = 0; $i <= $maxUser; $i++) {
                $user = new User();
                $user->setEmail($role['user'] . $i . '@gmail.com');
                $hashedPassword = $this->passwordHasher->hashPassword(
                    $user,
                    'password'
                );
                $user->setPassword($hashedPassword)
                    ->setRoles([$role['role']])
                    ->setCivility('Monsieur')
                    ->setFirstName('Jean')
                    ->setLastname('Dupont')
                    ->setBirthdate(new DateTime('2002-10-12'))
                    ->setPhone(0665575533)
                    ->setAdress1('333 rue de la gerla')
                    ->setAdress2('bis terrain du moulin')
                    ->setCity('Saint Siméon de Bressieux')
                    ->setZip('38870')
                    ->setCountry('France');
                $this->addReference($role['role'] . '_' . $i, $user);
                $manager->persist($user);
            };
        };
        $manager->flush();
    }
}
