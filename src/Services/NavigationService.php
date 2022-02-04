<?php

namespace App\Services;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;

class NavigationService
{
    public const ROLE_NOT_COMPLETED = [
        ['title' => 'Terminer mon inscription', 'path' => 'redirection'],
    ];

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
                ['title' => 'Mon CV', 'path' => $this->urlGenerator
                    ->generate('curriculum')],
                ['title' => 'Voir mes candidatures', 'path' => $this->urlGenerator
                    ->generate('student_application', ['slug' => $this->userService->getSlug()])],
                ['title' => 'Mes offres favorites', 'path' => $this->urlGenerator
                    ->generate('student_favorite', ['slug' => $this->userService->getSlug()])],
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
                    ->generate('company_application', ['slug' => $this->userService->getSlug()])],
            ];
        }
        if ($this->security->isGranted('ROLE_SCHOOL_COMPLETED')) {
            return [
                ['title' => 'Mon profil formation', 'path' => $this->generateUrl('user_home')],
                ['title' => 'Liste des étudiants', 'path' => $this->generateUrl('user_home')],
                ['title' => 'Suivi des étudiants', 'path' => $this->urlGenerator
                    ->generate('school_suivi_show', ['slug' => $this->userService->getSlug()])],
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
