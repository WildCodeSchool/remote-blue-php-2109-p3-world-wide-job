<?php

namespace App\Controller;

use App\Entity\Curriculum;
use App\Form\CvType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurriculumController extends AbstractController
{
    /**
     * @Route("/curriculum", name="curriculum")
     */
    public function index(Request $request): Response
    {
        $curriculum = new Curriculum();
        $form = $this->createForm(CvType::class, $curriculum)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($curriculum);
            $this->getDoctrine()->getManager()->flush();
            //Penser a rediriger vers la page de profil student
            return $this->redirectToRoute('home');
        }
        return $this->render('curriculum/cvCreate.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
