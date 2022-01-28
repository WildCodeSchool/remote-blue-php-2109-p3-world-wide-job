<?php

namespace App\Services;

use App\Repository\CompanyRepository;
use App\Repository\SchoolRepository;
use App\Repository\StudentRepository;
use Symfony\Component\Security\Core\Security;

class UserService
{
    private StudentRepository $studentRepository;
    private SchoolRepository $schoolRepository;
    private CompanyRepository $companyRepository;
    private Security $security;

    /**
     * UserService constructor.
     * @param StudentRepository $studentRepository
     * @param SchoolRepository $schoolRepository
     * @param CompanyRepository $companyRepository
     * @param Security $security
     */
    public function __construct(
        StudentRepository $studentRepository,
        SchoolRepository $schoolRepository,
        CompanyRepository $companyRepository,
        Security $security
    ) {
        $this->studentRepository = $studentRepository;
        $this->schoolRepository = $schoolRepository;
        $this->companyRepository = $companyRepository;
        $this->security = $security;
    }

    public function getSlug(): ?string
    {
        $slug = null;
        switch (true) {
            case $this->security->isGranted('ROLE_STUDENT_COMPLETED'):
                $loggedStudent = $this->studentRepository->findOneBy(['user' => $this->security->getUser()]);
                if ($loggedStudent) {
                    $slug = $loggedStudent->getSlug();
                }
                break;
            case $this->security->isGranted('ROLE_SCHOOL_COMPLETED'):
                $loggedSchool = $this->schoolRepository->findOneBy(['user' => $this->security->getUser()]);
                if ($loggedSchool) {
                    $slug = $loggedSchool->getSlug();
                }
                break;
            case $this->security->isGranted('ROLE_COMPANY_COMPLETED'):
                $loggedCompany = $this->companyRepository->findOneBy(['user' => $this->security->getUser()]);
                if ($loggedCompany) {
                    $slug = $loggedCompany->getSlug();
                }
                break;
        }
        return $slug;
    }
}
