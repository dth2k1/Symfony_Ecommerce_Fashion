<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::class, [
                'label' => 'Firstname',
                'attr' => [
                    'placeholder' => 'Type Your First Name'
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => 'Lastname',
                'attr' => [
                    'placeholder' => 'Type Your Last Name'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Type Your Email'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Message'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Send',
                'attr' => [
                    'class' => 'btn button-design'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
