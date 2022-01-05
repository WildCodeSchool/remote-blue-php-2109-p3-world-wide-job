<?php

namespace App\Controller;

use App\Form\FilterOfferType;
use App\Form\SearchOfferFormType;
use App\Repository\OfferRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/search", name="search_offer", methods={"GET"})
     */
    public function searchOffer(Request $request, OfferRepository $offerRepository): Response
    {
        $form = $this->createForm(FilterOfferType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['searchCity'];
            $offers = $offerRepository->findBy(['city' => $search]);
        } else {
            $offers = $offerRepository->findAll();
        }
        return $this->render('search/searchOffer.html.twig', [
            'offers' => $offers,
            'form' => $form->createView(),
        ]);
    }
}
