<?php

namespace App\Controller;

use App\Entity\User;
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
    public function logout(AuthenticationUtils $authenticationUtils)
    {

    }

    /**
     * @Route("/redirection", name="redirection")
     */
    public function redirected(Security $security, UrlGeneratorInterface $urlGenerator): RedirectResponse
    {


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
            return new RedirectResponse($urlGenerator->generate('student_show'));
        }
        if (
            $security->isGranted('ROLE_SCHOOL_COMPLETED')

        ) {
            return new RedirectResponse($urlGenerator->generate('school_show'));
        }
        if (
            $security->isGranted('ROLE_COMPANY_COMPLETED')

        ) {
            return new RedirectResponse($urlGenerator->generate('company_show'));
        }




        return new RedirectResponse($urlGenerator->generate('login '));
    }

}
