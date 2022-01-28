<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Offer;
use App\Entity\School;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\FilterCandidature;
use App\Repository\ApplicationRepository;
use App\Form\CompanyType;
use App\Form\PasswordEditType;
use App\Form\UserEditType;
use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entreprise", name="company_")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/{slug}/candidature", name="application")
     */
    public function searchApplication(
        Request $request,
        Company $company,
        ApplicationRepository $appliRepository
    ): Response {

        $form = $this->createFormBuilder()
        ->add('searchStudent', SearchType::class, [
            'required' => false,
            'attr' => ['placeholder' => 'Étudiant'],
        ])
            ->add('searchBySchool', EntityType::class, [
                'class' => School::class,
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.schoolName', 'ASC');
                },
                'placeholder' => "Ecole",
                'choice_label' => 'schoolName',
            ])
            ->add('searchByOffers', EntityType::class, [
                'class' => Offer::class,
                'required' => false,
                'placeholder' => "Vos offres",
                'choice_label' => 'name',
                'query_builder' => function (OfferRepository $er) use ($company) {
                    return $er->createQueryBuilder('o')
                        ->where('o.company = :company')
                        ->setParameter('company', $company)
                        ->orderBy('o.name', 'ASC');
                },
            ])
            ->add('submit', SubmitType::class)
             -> getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $student = $form->get('searchStudent')->getData();
            $offer = $form->get('searchByOffers')->getData();
            $school = $form->get('searchBySchool')->getData();
            if (!empty($student)) {
                    $candidatures = $appliRepository->findLikeStudent($student);
            } elseif (!empty($offer)) {
                $candidatures = $appliRepository->findByOffer($offer);
            } elseif (!empty($school)) {
                $candidatures = $appliRepository->findBySchool($school);
            } else {
                $candidatures = $appliRepository->findAllApplicationsByCompany($company);
            }
        } else {
            $candidatures = $appliRepository->findAllApplicationsByCompany($company);
        }

        return $this->render('company/searchCandidat.html.twig', [
            'candidatures' => $candidatures,
            'form' => $form->createView(),
        ]);
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

    /**
     * @Route("/{slug}/offres", name="index", methods={"GET", "POST"})
     */
    public function index(Company $company): Response
    {
        return $this->render('offers/index.html.twig', [
            'company' => $company
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="edit", methods={"GET", "POST"})
     *
     */
    public function edit(Request $request, Company $company, EntityManagerInterface $entityManager): Response
    {
        $companyForm = $this->createForm(CompanyType::class, $company);
        $companyForm->handleRequest($request);


        $userForm = $this->createForm(UserEditType::class, $company->getUser());
        $userForm->handleRequest($request);

        $passwordForm = $this->createForm(PasswordEditType::class, $company->getUser());
        $passwordForm->handleRequest($request);

        if ($companyForm->isSubmitted() && $companyForm->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre profil a été modifié');
        }

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre profil a été modifié');
        }

        if ($passwordForm->isSubmitted() && $passwordForm->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre mot de passe a été modifié');
        }


        return $this->renderForm('company/edit.html.twig', [
            'company' => $company,
            'form' => $companyForm,
             'userForm' => $userForm,
            'passwordForm' => $passwordForm
        ]);
    }

    /**
     * @Route("/{slug}/delete", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Company $company, EntityManagerInterface $entityManager): Response
    {
        $company->setStatus(false);
        $entityManager->flush();
        return $this->redirectToRoute('app_logout', ['slug' => $company->getSlug()], Response::HTTP_SEE_OTHER);
    }
}
