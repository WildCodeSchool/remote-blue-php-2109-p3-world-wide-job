<?php

namespace App\Form;

use App\Entity\Offer;
use App\Entity\School;
use App\Repository\OfferRepository;
use App\Services\AdminService;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterCandidature extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method' => 'get'
        ]);
    }
}
