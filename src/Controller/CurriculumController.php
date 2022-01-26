<?php

namespace App\Controller;

use App\Entity\Curriculum;
use App\Entity\Student;
use App\Form\CvType;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurriculumController extends AbstractController
{
    /**
     * @Route("/curriculum", name="curriculum")
     */
    public function index(Request $request, StudentRepository $studentRepository): Response
    {
        $student = $studentRepository->findOneBy(['user' => $this->getUser()]);
        $curriculum = new Curriculum();
        $form = $this->createForm(CvType::class, $curriculum)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $curriculum->setStudent($student);
            $this->getDoctrine()->getManager()->persist($curriculum);
            $this->getDoctrine()->getManager()->flush();
            //Penser a rediriger vers la page de profil student
            return $this->redirectToRoute('student_show', ['slug' => $student->getSlug()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('curriculum/cvCreate.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
