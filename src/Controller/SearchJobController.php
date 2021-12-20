<?php

namespace App\Controller;

use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchJobController extends AbstractController
{
    /**
     * @Route("/", name="search_offer", methods={"GET"})
     */
    public function searchOffer(OfferRepository $offerRepository): Response
    {
        return $this->render('rechercheBase.html.twig', [
            'offers' => $offerRepository->findAll(),
        ]);
    }
}
