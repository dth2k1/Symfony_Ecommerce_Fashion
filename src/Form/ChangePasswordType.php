<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true,         //User cannot change the value
                'label' => 'My email address'
            ])
            ->add('firstname', TextType::class, [
                'disabled' => true,
                'label' => 'My firstname'
            ])
            ->add('lastname', TextType::class, [
                'disabled' => true,
                'label' => 'My lastname'
            ])
            ->add('old_password', PasswordType::class, [
                'label' => 'My current password',
                'mapped' => false,         // Do not save it in BDD
                'attr' => [
                    'placeholder' => 'Type current password'
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'The new password and the confirmation must be identical',
                'label' => 'New password',
                'required' => true,
                'first_options' => [
                    'label' => 'New password',
                    'attr' => [
                        'placeholder' => "Type your new password"
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirm new password',
                    'attr' => [
                        'placeholder' => "Type Confirm new password"
                    ]
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Update password",
                'attr' => [
                    'class' => 'btn button-design'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
