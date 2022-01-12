<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CompanyRepository;
use App\Repository\SchoolRepository;
use App\Repository\StudentRepository;
use App\Services\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LoginController extends AbstractController
{
    /**
     * @Route("/connexion", name="login")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/déconnexion", name="app_logout")
     */
    public function logout(AuthenticationUtils $authenticationUtils): void
    {
    }

    /**
     * @Route("/redirection", name="redirection")
     */
    public function redirected(
        Security $security,
        UrlGeneratorInterface $urlGenerator,
        CompanyRepository $companyRepository,
        SchoolRepository $schoolRepository,
        StudentRepository $studentRepository,
        Slugify $slugify
    ): RedirectResponse {
        if (
            $security->isGranted('ROLE_STUDENT')
        ) {
            return new RedirectResponse($urlGenerator->generate('registration_student'));
        }
        if (
            $security->isGranted('ROLE_SCHOOL')
        ) {
            return new RedirectResponse($urlGenerator->generate('registration_school'));
        }
        if (
            $security->isGranted('ROLE_COMPANY')
        ) {
            return new RedirectResponse($urlGenerator->generate('registration_company'));
        }

        if (
            $security->isGranted('ROLE_STUDENT_COMPLETED')
        ) {
            $loggedStudent = $studentRepository->findOneBy(['user' => $this->getUser()]);
            if ($loggedStudent != null) {
                return new RedirectResponse($urlGenerator
                    ->generate('student_show', ['slug' => $loggedStudent->getSlug()]));
            }
        }
        if (
            $security->isGranted('ROLE_SCHOOL_COMPLETED')
        ) {
            $loggedSchool = $schoolRepository->findOneBy(['user' => $this->getUser()]);
            return new RedirectResponse($urlGenerator
                ->generate('school_show', ['slug' => $slugify->getSchoolSlug($loggedSchool)]));
        }
        if (
            $security->isGranted('ROLE_COMPANY_COMPLETED')
        ) {
            $loggedCompany = $companyRepository->findOneBy(['user' => $this->getUser()]);
            return new RedirectResponse($urlGenerator
                ->generate('company_show', ['slug' => $slugify->getCompanySlug($loggedCompany)]));
        }


        return new RedirectResponse($urlGenerator->generate('login'));
    }
}
