<?php

namespace App\Services;

use App\Entity\School;
use App\Entity\Company;
use App\Entity\Student;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RegistrationService
{
    private Security $security;
    private EntityManagerInterface $entityManager;
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(
        Security $security,
        EntityManagerInterface $entityManager,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
    }

    public function redirectAfterRegistration(): RedirectResponse
    {

        if (
            $this->security->isGranted('ROLE_STUDENT') &&
            empty($this->entityManager->getRepository(Student::class)
                ->findOneBy(['user' => $this->security->getUser()]))
        ) {
            return new RedirectResponse($this->urlGenerator->generate('registration_student'));
        } elseif (
            $this->security->isGranted('ROLE_SCHOOL') &&
            empty($this->entityManager->getRepository(School::class)
                ->findOneBy(['user' => $this->security->getUser()]))
        ) {
            return new RedirectResponse($this->urlGenerator->generate('registration_school'));
        } elseif (
            $this->security->isGranted('ROLE_COMPANY') &&
            empty($this->entityManager->getRepository(Company::class)
                ->findOneBy(['user' => $this->security->getUser()]))
        ) {
            return new RedirectResponse($this->urlGenerator->generate('registration_company'));
        }

        return new RedirectResponse($this->urlGenerator->generate('home'));
    }
}
