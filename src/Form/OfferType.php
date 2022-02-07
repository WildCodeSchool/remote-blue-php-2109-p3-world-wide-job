<?php

namespace App\Form;

use App\Entity\Offer;
use App\Services\AdminService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\Positive;

class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom de l'offre :",
                'required' => false,
                'attr' => [
                    'v-model' => "name"
                ]
            ])
            ->add('city', TextType::class, [
                'label' => "Ville :",
                'required' => false,
            ])
            ->add('contractType', ChoiceType::class, [
                'required' => false,
                'label' => "Type de contrat:",
                'choices' => AdminService::CONTRACTTYPE,
            ])
            ->add('shortDescription', TextType::class, [
                'label' => "Description courte :",
                'required' => false,
            ])
            ->add('longDescription', TextType::class, [
                'label' => "Description longue :",
                'required' => false,
            ])
            ->add('fieldOfActivity', ChoiceType::class, [
                'required' => false,
                'label' => "Secteur d'activité",
                'choices' => AdminService::FIELDOFACTIVITY,
            ])
            ->add('dateIn', DateType::Class, [
                'label' => "Date de début :",
                'required' => false,
            ])
            ->add('wage', IntegerType::class, [
                'label' => "Salaire :",
                'required' => false,
                'constraints' => [new Positive()],
                'attr' => [
                    'min' => 0
                ]
            ])
            ->add('tutor', TextType::class, [
                'label' => "Nom du tuteur",
                'required' => false,
            ])
            ->add('drivingLicence', ChoiceType::class, [
                'label' => "Permis de conduire obligatoire",
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
