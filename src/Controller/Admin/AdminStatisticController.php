<?php

namespace App\Controller\Admin;

use App\Repository\CompanyRepository;
use App\Repository\SchoolRepository;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

/**
 * @Route("/statistic", name="statistic_")
 */
class AdminStatisticController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(
        ChartBuilderInterface $chartBuilder,
        StudentRepository $studentRepository,
        CompanyRepository $companyRepository,
        SchoolRepository $schoolRepository
    ): Response {

        $allstudents = $studentRepository->findAll();
        $allCompanys = $companyRepository->findAll();
        $allSchools = $schoolRepository->findAll();

        $chart = $chartBuilder->createChart(Chart::TYPE_PIE);
        $chart->setData([
            'labels' => ['Étudiants', 'Entreprise', 'École'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => ['#ffbf89', '#9bff89', '#b089ff'],
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [count($allstudents), count($allCompanys), count($allSchools)],
                ],
            ],
        ]);




        return $this->render('admin/admin_statistic/index.html.twig', [
            'chart' => $chart,
        ]);
    }
}
