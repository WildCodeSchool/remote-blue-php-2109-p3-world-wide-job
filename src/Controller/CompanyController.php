<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Offer;
use App\Form\Company1Type;
use App\Form\CompanyEditType;
use App\Form\CompanyType;
use App\Form\PasswordEditType;
use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entreprise", name="company_")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/{id}", name="show")
     */
    public function show(Company $company, OfferRepository $offerRepository): Response
    {

        $applications = $offerRepository->findAllCountApplications($company);

        return $this->render('company/show.html.twig', [
            'company' => $company,
            'applications' => $applications
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Company $company, EntityManagerInterface $entityManager): Response
    {
        $companyForm = $this->createForm(CompanyType::class, $company);
        $companyForm->handleRequest($request);

        $passwordForm = $this->createForm(PasswordEditType::class, $company);
        $passwordForm->handleRequest($request);

        if ($companyForm->isSubmitted() && $companyForm->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('company_show', ['id' => $company->getId() ], Response::HTTP_SEE_OTHER);
        }

        if ($passwordForm->isSubmitted() && $passwordForm->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('company_show', ['id' => $company->getId() ], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('company/edit.html.twig', [
            'company' => $company,
            'form' => $companyForm,
            'passwordForm' => $passwordForm
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Company $company, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $company->getId(), $request->request->get('_token'))) {
            $entityManager->remove($company);
            $entityManager->flush();
        }

        return $this->redirectToRoute('company_index', [], Response::HTTP_SEE_OTHER);
    }
}
