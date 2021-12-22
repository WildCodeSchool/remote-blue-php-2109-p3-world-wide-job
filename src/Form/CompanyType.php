<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('companyName', TextType::class, [
                'label' => "Nom de l’entreprise :"
            ])
            ->add('companyFormat', ChoiceType::class, [
                'label' => 'Forme légale :',
                'choices'  => [
                    'SAS' => '1',
                    'EURL' => '2',
                    'SARL' => '3',
                    'Association' => '4',
                    'EURL' => '5',
                    'SA' => '6',
                ],

            ])
            ->add('siret', TextType::class, [
                'label' => "N° Siret :"
            ])
            ->add('siren', TextType::class, [
                'label' => "N° SIREN :"
            ])
            ->add('description', TextType::class, [
                'label' => "Description :"
            ])
            ->add('logoFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_uri' => true, // not mandatory, default is true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
