<?php

namespace App\Controller;

use App\Entity\School;
use App\Form\PasswordEditType;
use App\Form\SchoolType;
use App\Form\UserEditType;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/formation", name="school_")
 */
class SchoolController extends AbstractController
{
    /**
     * @Route("/{slug}", name="show")
     */
    public function show(School $school, StudentRepository $studentRepository): Response
    {
        $studentsAsc = $studentRepository->findAllNameAsc($school);
        $studentsByApp = $studentRepository->findAllByApplication($school);
        return $this->render('school/show.html.twig', [
            'school' => $school,
            'studentsAsc' => $studentsAsc,
            'studentsByApp' => $studentsByApp,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, School $school, EntityManagerInterface $entityManager): Response
    {
        $schoolForm = $this->createForm(SchoolType::class, $school);
        $schoolForm->handleRequest($request);

        $passwordForm = $this->createForm(PasswordEditType::class, $school->getUser());
        $passwordForm->handleRequest($request);

        $userForm = $this->createForm(UserEditType::class, $school->getUser());
        $userForm->handleRequest($request);

        if ($schoolForm->isSubmitted() && $schoolForm->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre profil a été modifié');
        }

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre profil a été modifié');
        }

        if ($passwordForm->isSubmitted() && $passwordForm->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre mot de passe a été modifié');
        }

        return $this->renderForm('school/edit.html.twig', [
            'school' => $school,
            'form' => $schoolForm,
            'userForm' => $userForm,
            'passwordForm' => $passwordForm,
        ]);
    }


    /**
     * @Route("/{slug}/delete", name="delete")
     */
    public function delete(Request $request, School $school, EntityManagerInterface $entityManager): Response
    {
        $school->setStatus(false);
        $entityManager->flush();
        return $this->redirectToRoute('app_logout', ['slug' => $school->getSlug()], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{slug}/suivi", name="suivi_show")
     * @return Response
     */
    public function studentFollow(School $school, StudentRepository $studentRepository): Response
    {
        $candidate = $studentRepository->findbyAllCandidate($school);
        return $this->render('school/suivi_show.html.twig', [
            'candidate' => $candidate
        ]);
    }
}
