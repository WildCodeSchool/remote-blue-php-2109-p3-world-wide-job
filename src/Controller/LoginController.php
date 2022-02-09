<?php

namespace App\Controller;

use App\Services\NavigationService;
use App\Services\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    private UrlGeneratorInterface $urlGenerator;
    private UserService $userService;
    private NavigationService $navigationService;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     * @param UserService $userService
     * @param NavigationService $navigationService
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        UserService $userService,
        NavigationService $navigationService
    ) {
        $this->urlGenerator = $urlGenerator;
        $this->userService = $userService;
        $this->navigationService = $navigationService;
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
        EntityManagerInterface $manager
    ): RedirectResponse {

        $logUser = $this->getUser();
        if ($logUser) {
            $logUser->setLastConnection();
            $manager->flush();
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
        } elseif (
            $security->isGranted('ROLE_ADMIN')
        ) {
            return new RedirectResponse($urlGenerator->generate('admin_home_index'));
        } else {
            return $this->redirectToCompletedAccount();
        }
    }

    private function redirectToCompletedAccount(): RedirectResponse
    {
        if ($this->userService->getSlug()) {
            return new RedirectResponse($this->navigationService->generateUrl('user_home'));
        }
        return new RedirectResponse($this->urlGenerator->generate('login'));
    }
}
