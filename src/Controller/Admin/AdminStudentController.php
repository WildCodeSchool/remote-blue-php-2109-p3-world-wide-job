<?php

namespace App\Controller\Admin;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/student", name="student_")
 */
class AdminStudentController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(StudentRepository $studentRepository): Response
    {
        return $this->render('admin/admin_student/index.html.twig', [
            'students' => $studentRepository->findAll(),
        ]);
    }
}
