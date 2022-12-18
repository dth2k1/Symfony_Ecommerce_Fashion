<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'What name would you like to give to your address',
                'attr' => [
                    'placeholder' => 'Address'
                ]
            ])
            ->add(
                'firstname',
                TextType::class,
                [
                    'label' => 'Firstname',
                    'attr' => [
                        'placeholder' => 'Type your firstname'
                    ]
                ]
            )
            ->add('lastname', TextType::class, [
                'label' => 'Lastname',
                'attr' => [
                    'placeholder' => 'Type your Lastname'
                ]
            ])
            ->add('company', TextType::class, [
                'label' => 'Your company',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Type your company'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'address',
                'attr' => [
                    'placeholder' => 'Hanoi...'
                ]
            ])
            ->add('postal', TextType::class, [
                'label' => 'ZipCode',
                'attr' => [
                    'placeholder' => 'Type Your zipCode'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'City',
                'attr' => [
                    'placeholder' => 'Type your city'
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => 'Country',
                'attr' => [
                    'placeholder' => 'Type your Country'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Phone number',
                'attr' => [
                    'placeholder' => 'type your phone number'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit address',
                'attr' => [
                    'class' => 'btn button-design'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
