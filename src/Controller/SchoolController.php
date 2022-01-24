<?php

namespace App\Controller;

use App\Entity\School;
use App\Form\CompanyType;
use App\Form\PasswordEditType;
use App\Form\School1Type;
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
     * @Route("/{id}/edit", name="school_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, School $school, EntityManagerInterface $entityManager): Response
    {
        $schoolForm = $this->createForm(SchoolType::class, $school);
        $schoolForm->handleRequest($request);

        $userForm = $this->createForm(UserEditType::class, $school->getUser());
        $userForm->handleRequest($request);

        $passwordForm = $this->createForm(PasswordEditType::class, $school);
        $passwordForm->handleRequest($request);

        if ($schoolForm->isSubmitted() && $schoolForm->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('school_show', ['slug' => $schoolForm->getSlug() ], Response::HTTP_SEE_OTHER);
        }

        if ($passwordForm->isSubmitted() && $schoolForm->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('company_show', ['slug' => $school->getSlug() ], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('company/edit.html.twig', [
            'company' => $school,
            'form' => $schoolForm,
            'userForm' => $userForm,
            'passwordForm' => $passwordForm
        ]);
    }

    /**
     * @Route("/{id}", name="school_delete", methods={"POST"})
     */
    public function delete(Request $request, School $school, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $school->getId(), $request->request->get('_token'))) {
            $entityManager->remove($school);
            $entityManager->flush();
        }

        return $this->redirectToRoute('schooll_index', [], Response::HTTP_SEE_OTHER);
    }
}
