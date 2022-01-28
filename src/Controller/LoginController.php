<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CompanyRepository;
use App\Repository\SchoolRepository;
use App\Repository\StudentRepository;
use App\Repository\UserRepository;
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
    private StudentRepository $studentRepository;
    private SchoolRepository $schoolRepository;
    private CompanyRepository $companyRepository;
    private UrlGeneratorInterface $urlGenerator;

    /**
     * @param StudentRepository $studentRepository
     * @param SchoolRepository $schoolRepository
     * @param CompanyRepository $companyRepository
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        StudentRepository $studentRepository,
        SchoolRepository $schoolRepository,
        CompanyRepository $companyRepository,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->studentRepository = $studentRepository;
        $this->schoolRepository = $schoolRepository;
        $this->companyRepository = $companyRepository;
        $this->urlGenerator = $urlGenerator;
    }


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
        UserRepository $userRepository,
        Slugify $slugify
    ): RedirectResponse {

        $logUser = $this->getUser();
        if ($logUser) {
            $logUser->setLastConnection();
        }

        if (
            $security->isGranted('ROLE_STUDENT')
        ) {
            return new RedirectResponse($urlGenerator->generate('registration_student'));
        } elseif (
            $security->isGranted('ROLE_SCHOOL')
        ) {
            return new RedirectResponse($urlGenerator->generate('registration_school'));
        } elseif (
            $security->isGranted('ROLE_COMPANY')
        ) {
            return new RedirectResponse($urlGenerator->generate('registration_company'));
        } else {
            return $this->redirectToCompletedAccount();
        }
    }

    private function redirectToCompletedAccount(): RedirectResponse
    {
        if (
            $this->isGranted('ROLE_STUDENT_COMPLETED')
        ) {
            $loggedStudent = $this->studentRepository->findOneBy(['user' => $this->getUser()]);
            if ($loggedStudent) {
                return new RedirectResponse($this->urlGenerator
                ->generate('student_show', ['slug' => $loggedStudent->getSlug()]));
            }
        } elseif (
            $this->isGranted('ROLE_SCHOOL_COMPLETED')
        ) {
            $loggedSchool = $this->schoolRepository->findOneBy(['user' => $this->getUser()]);
            if ($loggedSchool) {
                return new RedirectResponse($this->urlGenerator
                ->generate('school_show', ['slug' => $loggedSchool->getSlug()]));
            }
        } elseif (
            $this->isGranted('ROLE_COMPANY_COMPLETED')
        ) {
            $loggedCompany = $this->companyRepository->findOneBy(['user' => $this->getUser()]);
            if ($loggedCompany) {
                return new RedirectResponse($this->urlGenerator
                ->generate('company_show', ['slug' => $loggedCompany->getSlug()]));
            }
        }
        return new RedirectResponse($this->urlGenerator->generate('login'));
    }
}
