<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Offer;
use App\Repository\ApplicationRepository;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entreprise", name="company_")
 */
class CompanyController extends AbstractController
{

    /**
     * @Route("/candidature", name="application")
     */
    public function searchApplication(): Response
    {
        return $this->render('company/searchCandidat.html.twig');
    }

    /**
     * @Route("/{slug}", name="show")
     */
    public function show(Company $company, OfferRepository $offerRepository): Response
    {

        $applications = $offerRepository->findAllCountApplications($company);

        return $this->render('company/show.html.twig', [
            'company' => $company,
            'applications' => $applications
        ]);
    }


}
