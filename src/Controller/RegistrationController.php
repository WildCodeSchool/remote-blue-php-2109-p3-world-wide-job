<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\School;
use App\Entity\Company;
use App\Entity\Student;
use App\Form\SchoolType;
use App\Form\CompanyType;
use App\Form\StudentType;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/inscription", name="registration_")
 */
class RegistrationController extends AbstractController
{
    /**
     * @Route("/utilisateur/entreprise", name="company")
     *
     */
    public function registerCompany(Request $request, EntityManagerInterface $entityManager): Response
    {
        $company = new Company();
        $companyForm = $this->createForm(CompanyType::class, $company);
        $companyForm->handleRequest($request);
        if ($companyForm->isSubmitted() && $companyForm->isValid()) {
            $company->setUser($this->getUser());
            $entityManager->getRepository(User::class)->find($this->getUser()->getId())->setRoles(['ROLE_COMPANY_COMPLETED']);
            $entityManager->persist($company);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('registration/schoolForm.html.twig', [
            'form' => $companyForm->createView(),
        ]);
    }

    /**
     * @Route("/utilisateur/ecole", name="school")
     *
     */
    public function registerSchool(Request $request, EntityManagerInterface $entityManager): Response
    {
        $school = new School();
        $schoolForm = $this->createForm(SchoolType::class, $school);
        $schoolForm->handleRequest($request);
        if ($schoolForm->isSubmitted() && $schoolForm->isValid()) {
            $school->setUser($this->getUser());
            $entityManager->getRepository(User::class)->find($this->getUser()->getId())->setRoles(['ROLE_SCHOOL_COMPLETED']);
            $entityManager->persist($school);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('registration/schoolForm.html.twig', [
            'form' => $schoolForm->createView(),
        ]);
    }

    /**
     * @Route("/utilisateur/etudiant", name="student")
     *
     */
    public function registerStudent(Request $request, EntityManagerInterface $entityManager): Response
    {
        $student = new Student();
        $studentForm = $this->createForm(StudentType::class, $student);
        $studentForm->handleRequest($request);
        if ($studentForm->isSubmitted() && $studentForm->isValid()) {
            $student->setUser($this->getUser());
            $entityManager->getRepository(User::class)->find($this->getUser()->getId())->setRoles(['ROLE_STUDENT_COMPLETED']);
            $entityManager->persist($student);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('registration/studentForm.html.twig', [
            'form' => $studentForm->createView(),
        ]);
    }

    #[Route('/{role}', name: 'index')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        LoginFormAuthenticator $login,
        GuardAuthenticatorHandler $guard,
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
                    $form->get('plainPassword')->getData()
                )
            );
            switch ($role) {
                case 'ecole':
                    $user->setRoles(["ROLE_SCHOOL"]);
                    $entityManager->persist($user);
                    $entityManager->flush();
                    return $guard->authenticateUserAndHandleSuccess($user, $request, $login, 'main');
                case 'etudiant':
                    $user->setRoles(["ROLE_STUDENT"]);
                    $entityManager->persist($user);
                    $entityManager->flush();
                    return $guard->authenticateUserAndHandleSuccess($user, $request, $login, 'main');

                case 'entreprise':
                    $user->setRoles(["ROLE_COMPANY"]);
                    $entityManager->persist($user);
                    $entityManager->flush();
                    return $guard->authenticateUserAndHandleSuccess($user, $request, $login, 'main');
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
