<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Offer;
use App\Form\OfferType;
use App\Repository\CompanyRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\FilterOfferType;
use App\Repository\OfferRepository;
use App\Services\AdminService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/offres", name="offer_")
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/", name="search", methods={"GET"})
     */
    public function searchOffer(Request $request, OfferRepository $offerRepository): Response
    {
        $offers = "";
        $form = $this->createForm(FilterOfferType::class);
        $form->handleRequest($request);
        $contractType = AdminService::CONTRACTTYPE;
        if ($form->isSubmitted() && $form->isValid()) {
            $city = $form->getData()['searchCity'];
            $fieldOfActivity = $form->getData()['searchFieldOfActivity'];
            $typeOfContract = $form->getData()['searchTypeOfContract'];
            if (!empty($city)) {
                $offers = $offerRepository->findLikeCity($city);
            }
            if (!empty($fieldOfActivity)) {
                $offers = $offerRepository->findBy(['fieldOfActivity' => $fieldOfActivity]);
            }
            if (!empty($typeOfContract)) {
                $offers = $offerRepository->findBy(['contractType' => $typeOfContract]);
            } elseif (empty($city) && empty($fieldOfActivity) && empty($typeOfContract)) {
                $offers = $offerRepository->findAll();
            }
        } else {
            $offers = $offerRepository->findAll();
        }
        return $this->render('search/searchOffer.html.twig', [
            'offers' => $offers,
            'form' => $form->createView(),
            'typeOfContract' => $contractType,
        ]);
    }

    /**
     * @Route("/ajouter", name="_new", methods={"GET", "POST"})
     */
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        CompanyRepository $companyRepository
    ): Response {
        $company = $companyRepository->findOneBy(['user' => $this->getUser()]);
        $offer = new Offer();
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offer->setCompany($company)
                ->setDateOfPublication(new DateTime());
            $entityManager->persist($offer);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offers/new.html.twig', [
            'offer' => $offer,
            'form' => $form,
            'company' => $company
        ]);
    }

    /**
     * @Route("/{id}", name="_show", methods={"GET"})
     */
    public function show(Offer $offer): Response
    {
        return $this->render('offers/show.html.twig', [
            'offer' => $offer,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Offer $offer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('offer_search', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offers/edit.html.twig', [
            'offer' => $offer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="_delete", methods={"POST"})
     */
    public function delete(Request $request, Offer $offer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $offer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($offer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('offer_search', [], Response::HTTP_SEE_OTHER);
    }
}
