<?php

namespace App\Form;

use App\Classe\Search;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('string', TextType::class, [          // Text search
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Product name...',
                    'class' => 'form-control-sm'
                ]
            ])
            ->add('categories', EntityType::class, [    // Enable to link to an entity Cf Classes/search.php
                'label' => false,
                'required' => false,
                'class' => Category::class,             // Link with Category class
                'multiple' => true,                     // Multiple choices
                'expanded' => true                      // View in checkbox
            ])

            ->add('min', NumberType::class, [
                'label'  => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'min'
                ]
            ])
            ->add('max', NumberType::class, [
                'label'  => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'max'
                ]
            ])
            ->add('promo', CheckboxType::class, [
                'label'  => 'Voucher',
                'required' => false,
            ])

            ->add('submit', SubmitType::class, [
                'label'  => 'filter',
                'attr' => [
                    'class' => 'btn-block button-design'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,              // Link to search class : src/Classe/Search.php
            'method' => 'GET',                          // To allow user to copy URL
            'crsf_protection' => false,                 // No need for encryption
        ]);
    }

    public function getBlockPrefix()                    // To have a clean URL
    {
        return '';
    }
}
