<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse', 'disabled' => true
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom', 'disabled' => true
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom', 'disabled' => true
            ])
            ->add('old_password', PasswordType::class, [
                'label' => 'Ancien mot de passe', 'mapped' => false,
                'constraints' => new Length([
                    'min' => 6,
                    'max' => 100
                ]), 'attr' => [
                    'placeholder' => 'Tapez votre ancien mot de passe',
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => "Le mot de passe de confirmation ne correspond pas",
                'constraints' => new Length([
                    'min' => 6,
                    'max' => 100
                ]),
                'required' => true,
                'first_options' => ['label' => 'Mot de passe actuel', 'attr' => [
                    'placeholder' => 'Saisissez votre mot de passe actuel'
                ]],
                'second_options' => ['label' => 'Confirmez le mot de passe actuel', 'attr' => [
                    'placeholder' => 'Confirmmez votre mot de passe actuel'
                ]]
            ])

            ->add('submit', SubmitType::class, [
                'label' => "Mettre à jour"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
