<?php

namespace App\Form;

use App\Entity\Training;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrainingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('degree', TextType::class, [
                'label' => 'Intitulé du diplôme'
            ])
            ->add('school', TextType::class, [
                'label' => "Nom de l'établissement"
            ])
            ->add('dateIn', DateType::class, [
                'label' => "Date de début",
                'widget' => "single_text"
            ])
            ->add('dateOut', DateType::class, [
                'label' => "Date de fin",
                'widget' => 'single_text'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de la formation'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Training::class,
        ]);
    }
}
