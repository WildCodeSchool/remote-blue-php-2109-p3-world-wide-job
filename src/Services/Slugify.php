<?php

namespace App\Services;

use App\Entity\Company;
use App\Entity\School;
use App\Entity\Student;
use Symfony\Component\String\Slugger\SluggerInterface;

class Slugify
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function generate(string $input): string
    {
        return $this->slugger->slug(strtolower($input));
    }

    public function getCompanySlug(?Company $company): ?string
    {
        $slug = "";
        if ($company != null) {
            $slug = $company->getSlug();
        }
        return $slug;
    }

    public function getStudentSlug(?Student $student): ?string
    {
        $slug = "";
        if ($student != null) {
            $slug = $student->getSlug();
        }
        return $slug;
    }

    public function getSchoolSlug(?School $school): ?string
    {
        $slug = "";
        if ($school != null) {
            $slug = $school->getSlug();
        }
        return $slug;
    }
}
