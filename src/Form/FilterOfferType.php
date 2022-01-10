<?php

namespace App\Form;

use App\Entity\Offer;
use App\Repository\OfferRepository;
use App\Services\TypeOfContract;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $typeOfContract = new TypeOfContract();
        $builder
            ->add('searchCity', SearchType::class, [
                'required' => false,
                'attr' => ['placeholder' => 'Localisation'],
            ])
            ->add('searchFieldOfActivity', ChoiceType::class, [
                'required' => false,
                'placeholder' => "Domaine d'activité",
                'choices' => $typeOfContract->getFieldOfActivity(),
            ])
            ->add('searchTypeOfContract', ChoiceType::class, [
                'required' => false,
                'placeholder' => "Type de contrat",
                'choices' => $typeOfContract->getContractType(),
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method' => 'get'
        ]);
    }
}
