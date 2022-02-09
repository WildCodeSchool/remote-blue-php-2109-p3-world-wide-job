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

    public const FIRSTNAME = [
        'Naim',
        'Samuel',
        'Ismael',
        'Pierre',
        'Florian',
        'Romain',
        'Valene'
    ];

    public const LASTNAME = [
        'Jhuboo',
        'Dupont',
        'Le Tellier',
        'Duplantier',
        'Malotino',
        'Reno',
        'Depardieu'
    ];

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::USERROLES as $role) {
            $counter = 0;
            foreach (self::FIRSTNAME as $firstname) {
                foreach (self::LASTNAME as $lastname) {
                    $user = new User();
                    $user->setEmail($role['user'] . $counter . '@gmail.com');
                    $hashedPassword = $this->passwordHasher->hashPassword(
                        $user,
                        'password'
                    );
                    $user->setPassword($hashedPassword)
                        ->setRoles([$role['role']])
                        ->setCivility('Monsieur')
                        ->setFirstName($firstname)
                        ->setLastname($lastname)
                        ->setBirthdate(new DateTime('2002-10-12'))
                        ->setPhone(0665575533)
                        ->setAdress1('333 rue de la gerla')
                        ->setAdress2('bis terrain du moulin')
                        ->setCity('Saint Siméon de Bressieux')
                        ->setZip('38870')
                        ->setCountry('France')
                        ->setLastConnection();
                    $this->addReference($role['role'] . '_' . $counter, $user);
                    $manager->persist($user);
                    $counter++;
                };
            };
        };
        $user = new User();
        $user->setEmail('admin@gmail.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'admin'
        );
        $user->setPassword($hashedPassword)
            ->setRoles(['ROLE_ADMIN'])
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
        $manager->persist($user);
        $manager->flush();
    }
}
