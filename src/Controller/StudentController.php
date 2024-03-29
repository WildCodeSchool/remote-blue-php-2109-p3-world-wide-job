<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Entity\Student;
use App\Form\PasswordEditType;
use App\Form\RegistrationFormType;
use App\Form\StudentType;
use App\Form\UserEditType;
use App\Services\AdminService;
use App\Repository\ApplicationRepository;
use App\Repository\OfferRepository;
use App\Services\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/etudiant", name="student_")
 */
class StudentController extends AbstractController
{
    private Slugify $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    /**
     * @Route("/{slug}", name="show")
     */
    public function show(Student $student): Response
    {
        $contractCv = AdminService::CONTRACTCV;
        return $this->render('student/show.html.twig', [
            'student' => $student,
            'contract' => $contractCv,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Student $student, EntityManagerInterface $entityManager): Response
    {
        if (!($this->getUser() == $student->getUser())) {
            throw new AccessDeniedException('Seul ' . $student->getUsername() . ' peut modifier son profil.');
        }
        $studentForm = $this->createForm(StudentType::class, $student);
        $studentForm->handleRequest($request);

        $passwordForm = $this->createForm(PasswordEditType::class, $student->getUser());
        $passwordForm->handleRequest($request);

        $userForm = $this->createForm(UserEditType::class, $student->getUser());
        $userForm->handleRequest($request);

        if ($studentForm->isSubmitted() && $studentForm->isValid()) {
            $student->setSlug($this->slugify->generate($student->getUsername()));
            $entityManager->flush();
            $this->addFlash('success', 'Votre profil a été modifié');
        }

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre profil a été modifié');
        }


        if ($passwordForm->isSubmitted() && $passwordForm->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre profil a été modifié');
        }

        return $this->renderForm('student/edit.html.twig', [
            'student' => $student,
            'form' => $studentForm,
            'userForm' => $userForm,
            'passwordForm' => $passwordForm,
        ]);
    }

    /**
     * @Route("/{slug}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Student $student, EntityManagerInterface $entityManager): Response
    {
        $student->setStatus(false);
        $entityManager->flush();
        return $this->redirectToRoute('app_logout', ['slug' => $student->getSlug()], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{slug}/favoris", name="favorite")
     */
    public function showFavorite(Student $student): Response
    {
        return $this->render('favorite/favorite_show.html.twig', [
            'student' => $student,
        ]);
    }

    /**
     * @Route("/{slug}/applications", name="application")
     */
    public function applications(Student $student): Response
    {
        return $this->render('student/applications.html.twig', [
            'student' => $student
        ]);
    }
}
