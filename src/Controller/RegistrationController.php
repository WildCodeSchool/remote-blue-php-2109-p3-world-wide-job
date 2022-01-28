<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\School;
use App\Entity\Student;
use App\Entity\User;
use App\Form\CompanyType;
use App\Form\RegistrationFormType;
use App\Form\SchoolType;
use App\Form\StudentType;
use App\Security\EmailVerifier;
use App\Security\SecurityAuthenticator;
use App\Services\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

/**
 * @Route("/inscription", name="registration_")
 */
class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(
        EmailVerifier $emailVerifier
    ) {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/utilisateur/entreprise", name="company")
     *
     */
    public function registerCompany(
        Request $request,
        EntityManagerInterface $entityManager,
        Slugify $slugify,
        UserAuthenticatorInterface $userAuthenticator,
        SecurityAuthenticator $authenticator
    ): Response {
        $company = new Company();
        $companyForm = $this->createForm(CompanyType::class, $company);
        $companyForm->handleRequest($request);
        if ($companyForm->isSubmitted() && $companyForm->isValid()) {
            $loggedUser = $this->getUser();
            if ($loggedUser != null) {
                $loggedUser =  $entityManager->
                getRepository(User::class)->
                findOneBy(['email' => $loggedUser->getUserIdentifier()]);
                $company->setUser($loggedUser);
                $company->setSlug($slugify
                    ->generate($company->getCompanyName()));
                $company->setStatus(true);
                if ($loggedUser != null) {
                    $loggedUser->setRoles(['ROLE_COMPANY_COMPLETED']);
                }
            }
            $entityManager->persist($company);
            $entityManager->flush();

            $userAuthenticator->authenticateUser(
                $this->getUser(),
                $authenticator,
                $request
            );
            return $this->redirectToRoute('company_show', ['slug' => $company->getSlug()]);
        }
        return $this->render('registration/companyForm.html.twig', [
            'form' => $companyForm->createView(),
        ]);
    }

    /**
     * @Route("/utilisateur/ecole", name="school")
     *
     */
    public function registerSchool(
        Request $request,
        EntityManagerInterface $entityManager,
        Slugify $slugify,
        UserAuthenticatorInterface $userAuthenticator,
        SecurityAuthenticator $authenticator
    ): Response {
        $school = new School();
        $schoolForm = $this->createForm(SchoolType::class, $school);
        $schoolForm->handleRequest($request);
        if ($schoolForm->isSubmitted() && $schoolForm->isValid()) {
            $loggedUser = $this->getUser();
            if ($loggedUser != null) {
                $loggedUser =  $entityManager->
                getRepository(User::class)->
                findOneBy(['email' => $loggedUser->getUserIdentifier()]);
                $school->setUser($loggedUser);
                $school->setStatus(true);
                $school->setSlug($slugify->
                generate($school->getSchoolName()));
                $school->setStatus(true);
                if ($loggedUser != null) {
                    $loggedUser->setRoles(['ROLE_SCHOOL_COMPLETED']);
                }
            }
            $entityManager->persist($school);
            $entityManager->flush();

            $userAuthenticator->authenticateUser(
                $this->getUser(),
                $authenticator,
                $request
            );
            return $this->redirectToRoute('school_show', ['slug' => $school->getSlug()]);
        }
        return $this->render('registration/schoolForm.html.twig', [
            'form' => $schoolForm->createView(),
        ]);
    }

    /**
     * @Route("/utilisateur/etudiant", name="student")
     *
     */
    public function registerStudent(
        Request $request,
        EntityManagerInterface $entityManager,
        UserAuthenticatorInterface $userAuthenticator,
        SecurityAuthenticator $authenticator,
        Slugify $slugify
    ): Response {
        $student = new Student();
        $studentForm = $this->createForm(StudentType::class, $student);
        $studentForm->handleRequest($request);
        if ($studentForm->isSubmitted() && $studentForm->isValid()) {
            $loggedUser = $this->getUser();
            if ($loggedUser != null) {
                $loggedUser =  $entityManager->
                getRepository(User::class)->
                findOneBy(['email' => $loggedUser->getUserIdentifier()]);
                $student->setUser($loggedUser);
                $student->setSlug($slugify
                    ->generate($student->getUsername()));
                $student->setStatus(true);
                if ($loggedUser != null) {
                    $loggedUser->setRoles(['ROLE_STUDENT_COMPLETED']);
                }
            }
            $entityManager->persist($student);
            $entityManager->flush();
            $userAuthenticator->authenticateUser(
                $this->getUser(),
                $authenticator,
                $request
            );

            return $this->redirectToRoute('student_show', ['slug' => $student->getSlug()]);
        }
        return $this->render('registration/studentForm.html.twig', [
            'form' => $studentForm->createView(),
        ]);
    }

    /**
     * @Route("/{role}", name="index")
     */
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        UserAuthenticatorInterface $userAuthenticator,
        SecurityAuthenticator $authenticator,
        EntityManagerInterface $entityManager,
        string $role
    ): ?Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    strval($form->get('plainPassword')->getData())
                )
            );
            switch ($role) {
                case "ecole":
                    $user->setRoles(["ROLE_SCHOOL"]);
                    break;
                case "etudiant":
                    $user->setRoles(["ROLE_STUDENT"]);
                    break;
                case "entreprise":
                    $user->setRoles(["ROLE_COMPANY"]);
                    break;
            }
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation(
                'registration_app_verify_email',
                $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@worldWideJob.com', 'Administrator'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            // do anything else you need here, like send an email
            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
            // return $this->redirectToRoute('home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('home');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('home');
    }
}
