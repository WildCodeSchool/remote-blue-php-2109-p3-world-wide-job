<?php

namespace App\Services;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;

class NavigationService
{
    public const ROLE_NOT_COMPLETED = [
        ['title' => 'Terminer mon inscription', 'path' => 'redirection'],
    ];
//    public const COMPANY_COMPLETED = [
//        ['title' => 'Mon profil entreprise', 'path' => 'company_show'],
//        ['title' => 'Créer une offre', 'path' => 'company_show'],
//        ['title' => 'Voir mes offres', 'path' => 'company_show'],
//        ['title' => 'Consulter mes candidature', 'path' => 'company_show'],
//    ];

//    public const SCHOOL_COMPLETED = [
//        ['title' => 'Mon profil formation', 'path' => 'school_show'],
//        ['title' => 'Liste des étudiants', 'path' => 'school_show'],
//        ['title' => 'Suivie de mes étudiants', 'path' => 'school_show'],
//        ['title' => 'Mes cursus', 'path' => 'school_show'],
//    ];

//    public const STUDENT_COMPLETED = [
//        ['title' => 'Mon profil étudiant', 'path' => 'student_show'],
//        ['title' => 'Faire mon CV', 'path' => 'curriculum'],
//        ['title' => 'Voir mes candidatures', 'path' => 'student_show'],
//        ['title' => 'Mes offres favorites', 'path' => 'student_show'],
//    ];

    private Security $security;
    private UrlGeneratorInterface $urlGenerator;
    private UserService $userService;

    /**
     * @param Security $security
     * @param UrlGeneratorInterface $urlGenerator
     * @param UserService $userService
     */
    public function __construct(
        Security $security,
        UrlGeneratorInterface $urlGenerator,
        UserService $userService
    ) {
        $this->security = $security;
        $this->urlGenerator = $urlGenerator;
        $this->userService = $userService;
    }

    public function userLinks(): array
    {
        if ($this->security->isGranted('ROLE_STUDENT_COMPLETED')) {
            return [
                ['title' => 'Mon profil étudiant', 'path' => $this->generateUrl('user_home')],
                ['title' => 'Faire mon CV', 'path' => $this->urlGenerator
                    ->generate('curriculum')],
                ['title' => 'Voir mes candidatures', 'path' => $this->urlGenerator
                    ->generate('student_show', ['slug' => $this->userService->getSlug()])],
                ['title' => 'Mes offres favorites', 'path' => $this->urlGenerator
                    ->generate('student_show', ['slug' => $this->userService->getSlug()])],
            ];
        }
        if ($this->security->isGranted('ROLE_COMPANY_COMPLETED')) {
            return [
                ['title' => 'Mon profil entreprise', 'path' => $this->generateUrl('user_home')],
                ['title' => 'Créer une offre', 'path' => $this->urlGenerator
                    ->generate('offer_new')],
                ['title' => 'Voir mes offres', 'path' => $this->urlGenerator
                    ->generate('company_index', ['slug' => $this->userService->getSlug()])],
                ['title' => 'Consulter mes candidature', 'path' => $this->urlGenerator
                    ->generate('company_index', ['slug' => $this->userService->getSlug()])],
            ];
        }
        if ($this->security->isGranted('ROLE_SCHOOL_COMPLETED')) {
            return [
                ['title' => 'Mon profil étudiant', 'path' => $this->generateUrl('user_home')],
                ['title' => 'Faire mon CV', 'path' => 'curriculum'],
                ['title' => 'Voir mes candidatures', 'path' => 'student_show'],
                ['title' => 'Mes offres favorites', 'path' => 'student_show'],
            ];
        }

        return self::ROLE_NOT_COMPLETED;
    }

    public function generateUrl(string $route): string
    {
        $url = '';
        switch ($route) {
            case 'user_home':
                if ($this->security->isGranted('ROLE_STUDENT_COMPLETED')) {
                    $url = $this->urlGenerator
                        ->generate('student_show', ['slug' => $this->userService->getSlug()]);
                }
                if ($this->security->isGranted('ROLE_COMPANY_COMPLETED')) {
                    $url = $this->urlGenerator
                        ->generate('company_show', ['slug' => $this->userService->getSlug()]);
                }
                if ($this->security->isGranted('ROLE_SCHOOL_COMPLETED')) {
                    $url = $this->urlGenerator
                        ->generate('school_show', ['slug' => $this->userService->getSlug()]);
                }
                break;
        }
        return $url;
    }
}
