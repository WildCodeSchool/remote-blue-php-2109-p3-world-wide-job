<?php

namespace App\Form;

use App\Entity\Degree;
use App\Entity\School;
use App\Entity\Student;
use App\Repository\DegreeRepository;
use App\Repository\SchoolRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pictureFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true, // not mandatory, default is true
                'download_uri' => true, // not mandatory, default is true
            ])
            ->add('ine', TextType::class, [
                'label' => "INE :"
            ])
            ->add('username', TextType::class, [
                'label' => "Pseudo :"
            ])
            ->add('description', TextareaType::class, [
                'label' => "INE :"
            ])
            ->add('school', EntityType::class, [
                "class" => School::class,
                "choice_label" => "schoolName",
                'multiple' => false,
                'query_builder' => function (SchoolRepository $repository) {
                    return $repository->createQueryBuilder('s')->orderBy('s.schoolName', 'ASC');
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
