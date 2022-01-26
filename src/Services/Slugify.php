<?php

namespace App\Services;

use App\Entity\Company;
use App\Repository\CompanyRepository;
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
}
