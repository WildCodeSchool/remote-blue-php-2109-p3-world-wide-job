<?php

namespace App\Controller;

use App\Entity\School;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
