<?php

namespace App\Services;

use App\Entity\School;
use App\Entity\Company;
use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
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

    public function roleAttribution(string $type): ?array
    {
        $role = [];
        switch ($type) {
            case "ecole":
                $role = ["ROLE_SCHOOL"];
                break;
            case "etudiant":
                $role = ["ROLE_STUDENT"];
                break;
            case "entreprise":
                $role = ["ROLE_COMPANY"];
                break;
        }
        return $role;
    }

    public function redirectAfterRegistration(): RedirectResponse
    {
        $redirectionResponse = "";
        if (
            $this->security->isGranted('ROLE_STUDENT') &&
            empty($this->entityManager->getRepository(Student::class)
                ->findOneBy(['user' => $this->security->getUser()]))
        ) {
            $redirectionResponse = $this->urlGenerator->generate('registration_student');
        } elseif (
            $this->security->isGranted('ROLE_SCHOOL') &&
            empty($this->entityManager->getRepository(School::class)
                ->findOneBy(['user' => $this->security->getUser()]))
        ) {
            $redirectionResponse = $this->urlGenerator->generate('registration_school');
        } elseif (
            $this->security->isGranted('ROLE_COMPANY') &&
            empty($this->entityManager->getRepository(Company::class)
                ->findOneBy(['user' => $this->security->getUser()]))
        ) {
            $redirectionResponse = $this->urlGenerator->generate('registration_company');
        }

        return new RedirectResponse($redirectionResponse);
    }
}
