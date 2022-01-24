<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder


            ->add('civility', ChoiceType::class, [
                'label' => 'Civilité',
                'error_bubbling' => true,
                'choices'  => [
                    'Monsieur' => 'Monsieur',
                    'Madame' => 'Madame',
                    'Non-genré' => 'non-genré',
                    'required' => false
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'error_bubbling' => true,
                'required' => false
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'error_bubbling' => true,
                'required' => false
            ])
            ->add('birthdate', BirthdayType::class, [
                'label' => 'Date de naissance',
                'error_bubbling' => true,
                'required' => false
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                'error_bubbling' => true,
                'required' => false
            ])
            ->add('adress1', TextType::class, [
                'label' => 'Adresse',
                'error_bubbling' => true,
                'required' => false
            ])
            ->add('adress2', TextType::class, [
                'label' => 'Adresse (suite)',
                'error_bubbling' => true,
                'required' => false
            ])
            ->add('zip', TextType::class, [
                'label' => 'Code Postal',
                'error_bubbling' => true,
                'required' => false
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'error_bubbling' => true,
                'required' => false

            ])
            ->add('country', TextType::class, [
                'label' => 'Pays',
                'error_bubbling' => true,
                'required' => false
            ])
            ->add('email', EmailType::class, [
                'label' => 'Mail',
                'error_bubbling' => true,
                'required' => false
            ])
            ->add('submit', SubmitType::class)



        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
