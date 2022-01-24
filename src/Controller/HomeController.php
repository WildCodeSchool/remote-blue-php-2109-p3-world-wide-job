<?php

namespace App\Controller;

use App\Repository\ApplicationRepository;
use App\Repository\CompanyRepository;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(
        StudentRepository $studentRepository,
        ApplicationRepository $appRepository,
        CompanyRepository $companyRepository
    ): Response {
        $countStudents = $studentRepository->findAll();
        $countApplications = $appRepository->findAll();
        $countCompanies = $companyRepository->findAll();
        $signedApllications = $appRepository->findBy(['status' => 3]);
        return $this->render('home/index.html.twig', [
            'countStudents' => $countStudents,
            'countApplications' => $countApplications,
            'countCompanies' => $countCompanies,
            'signedApplications' => $signedApllications
        ]);
    }
}
