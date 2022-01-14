<?php

namespace App\Services;

use Symfony\Component\Security\Core\Security;

class NavigationService
{
    public const ROLE_NOT_COMPLETED = [
        ['title' => 'Terminer mon inscription', 'path' => 'redirection'],
    ];
    public const COMPANY_COMPLETED = [
        ['title' => 'Mon profil entreprise', 'path' => 'company_show'],
        ['title' => 'Créer une offre', 'path' => 'company_show'],
        ['title' => 'Voir mes offres', 'path' => 'company_show'],
        ['title' => 'Consulter mes candidature', 'path' => 'company_show'],
    ];

    public const SCHOOL_COMPLETED = [
        ['title' => 'Mon profil formation', 'path' => 'school_show'],
        ['title' => 'Liste des étudiants', 'path' => 'school_show'],
        ['title' => 'Suivie de mes étudiants', 'path' => 'school_show'],
        ['title' => 'Mes cursus', 'path' => 'school_show'],
    ];

    public const STUDENT_COMPLETED = [
        ['title' => 'Mon profil étudiant', 'path' => 'student_show'],
        ['title' => 'Faire mon CV', 'path' => 'student_show'],
        ['title' => 'Voir mes candidatures', 'path' => 'student_show'],
        ['title' => 'Mes offres favorites', 'path' => 'student_show'],
    ];

    private Security $security;

    /**
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function userLinks()
    {
        if ($this->security->isGranted('ROLE_STUDENT_COMPLETED')) {
            return self::STUDENT_COMPLETED;
        }
        if ($this->security->isGranted('ROLE_SCHOOL_COMPLETED')) {
            return self::SCHOOL_COMPLETED;
        }
        if ($this->security->isGranted('ROLE_COMPANY_COMPLETED')) {
            return self::COMPANY_COMPLETED;
        }

        return self::ROLE_NOT_COMPLETED;
    }
}
