<?php

namespace App\Form;

use App\Entity\Curriculum;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class CvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pictureFile', VichFileType::class, [
                'required' => false,
            ])
            ->add('language', TextType::class)
            ->add('drivingLicence', CheckboxType::class)
            ->add('skills', TextType::class)
            ->add('experiences', CollectionType::class, [
                "entry_type" => ExperienceType::class,
                "by_reference" => false,
                "allow_add" => true,
                "allow_delete" => true
            ])
            ->add('trainings', CollectionType::class, [
                "entry_type" => TrainingType::class,
                "by_reference" => false,
                "allow_add" => true,
                "allow_delete" => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Curriculum::class,
        ]);
    }
}
