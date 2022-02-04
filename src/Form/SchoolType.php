<?php

namespace App\Form;

use App\Entity\School;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class SchoolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('schoolName', TextType::class, [
                'label' => "Nom de l’établissement :"
            ])
            ->add('schoolCode', TextType::class, [
                'label' => 'Intitulé de la formation :'
            ])
            ->add('schoolDesc', TextareaType::class, [
                'label' => "Description de la formation :"
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type d’établissement :',
                'choices'  => [
                    'Université' => '1',
                    'Ecole' => '2',
                    'Formation' => '3',
                    'BTS' => '4',
                    'IUT' => '5',
                    'Lycée' => '6',
                ],

            ])
            ->add('logoFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_uri' => true, // not mandatory, default is true
                'label' => "Logo de l'établissement"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => School::class,
        ]);
    }
}
