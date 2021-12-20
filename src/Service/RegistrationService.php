<?php

namespace App\Service;

use App\Entity\School;
use App\Entity\Company;
use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RegistrationService
{

    private $security;
    private $entityManager;
    private $urlGenerator;

    public function __construct(Security $security, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator,)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
    }

    public function redirectAfterRegistration()
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
    }
}
