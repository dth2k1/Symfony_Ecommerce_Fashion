<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'First Name',
                'attr' => [
                    'placeholder' => 'Type Your First Name'
                ],
                'constraints' => new Length([
                    'min' => 2,
                    'minMessage' => 'Less than {{ limit }} character',
                    // max length allowed by Symfony for security reasons
                    'max' => 30,
                ]),
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Last Name',
                'attr' => [
                    'placeholder' => 'Type Your Last Name'
                ],
                'constraints' => new Length([
                    'min' => 2,
                    'minMessage' => 'Less than {{ limit }} character',
                    // max length allowed by Symfony for security reasons
                    'max' => 30,
                ]),
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Type Your Email'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Password invalid',
                'label' => 'Password',
                'required' => true,
                'first_options' => [
                    'label' => 'Password',
                    'attr' => [
                        'placeholder' => "Type your Password"
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirm password',
                    'attr' => [
                        'placeholder' => "Type your Confirm Password"
                    ]
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Password cant not blank',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'password less than {{ limit }} character',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Signup',
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
