<?php

namespace App\Controller;

use App\Entity\Application;
use App\Form\FilterOfferType;
use App\Repository\OfferRepository;
use App\Repository\StudentRepository;
use App\Services\AdminService;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/offres", name="search_offer", methods={"GET"})
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
     * @Route("/offres/{application}", name="search_offer_apply")
     */
    public function addApplication(
        int $offerId,
        Request $request,
        Application $application,
        EntityManagerInterface $entityManager,
        OfferRepository $offerRepository,
        StudentRepository $studentRepository
    ): Response {
        $offer = $offerRepository->findOneBy(['id' => $offerId]);
        $student = $studentRepository->findOneBy([$this->getUser()]);
        $application->setStudent($student)
            ->setOffer($offer)
            ->setStatus(1);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($application);
        $entityManager->flush();
        return $this->json(['isApplicated' => true]);
    }
}
