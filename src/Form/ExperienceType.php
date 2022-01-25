<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('jobPosition', TextType::class, [
                'label' => 'Intitulé du poste'
            ])
            ->add('company', TextType::class, [
                'label' => "Nom de l'entreprise"
            ])
            ->add('localisation', TextType::class, [
                'label' => 'Localisation'
            ])
            ->add('contractType', ChoiceType::class, [
                'label' => 'Type de contrat',
                'choices' => ['CDI' => 1, 'CDD' => 2, 'Stage' => 3, 'Alternance' => 4]
            ])
            ->add('dateIn', DateType::class, [
                'label' => "Date de début",
                'widget' => 'single_text'
            ])
            ->add('dateOut', DateType::class, [
                'label' => "Date de fin",
                'widget' => 'single_text'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du poste'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
