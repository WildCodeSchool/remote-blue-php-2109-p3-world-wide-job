<?php

namespace App\Form;

use App\Entity\School;
use App\Entity\Student;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('ine')
            ->add('school', EntityType::class, [
                'class' => School::class,
                'query_builder' => function (EntityRepository $repository) {
                    return $repository->createQueryBuilder('s')->orderBy('s.schoolName', 'ASC');
                },
                'choice_label' => 'schoolName',
                'multiple' => false,
                'expanded' => false,
                'by_reference' => false,
            ])
            ->add('pictureFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_uri' => true, // not mandatory, default is true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
