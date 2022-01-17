<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Offer;
use App\Form\FilterOfferType;
use App\Repository\ApplicationRepository;
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
     * @Route("/offres/{id}/apply", name="offer_apply")
     */
    public function addApplication(
        int $id,
        EntityManagerInterface $entityManager,
        OfferRepository $offerRepository,
        StudentRepository $studentRepository,
        ApplicationRepository $applicationRepo
    ): Response {
        $offer = $offerRepository->findOneBy(['id' => $id]);
        $student = $studentRepository->findOneBy(['user' => $this->getUser()]);

        if ($offer->isAppliedByStudent($student)) {
            $applied = $applicationRepo->findOneBy([
                'offer' => $offer,
                'student' => $student
            ]);
            $entityManager->remove($applied);
            $entityManager->flush();

            return $this->json([
                'message' => 'Postulat bien retiré',
                'isApplied' => $applicationRepo->findOneBy([
                    'offer' => $offer,
                    'student' => $student
                ])
                ], 200);
        }
        $application = new Application();
        $application->setOffer($offer)
            ->setStudent($student)
            ->setStatus(1);
        $entityManager->persist($application);
        $entityManager->flush();
        return $this->json(['message' => 'Postulat pris en compte','isApplied' => $applicationRepo->findOneBy([
            'offer' => $offer,
            'student' => $student]), 200]);
    }
}
