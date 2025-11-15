<?php

namespace App\Form;

use App\Entity\Credit;
use App\Entity\Person;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('documentId', TextType::class, [
                'label' => 'Beleg-ID',
                'required' => true,
            ])
            ->add('person', EntityType::class, [
                'class' => Person::class,
                'choice_label' => 'name',
                'placeholder' => 'Bitte wählen',
                'required' => false,
                'label' => 'Person',
            ])
            ->add('billingPeriode', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Abrechnungsperiode',
            ])
            ->add('creditItems', CollectionType::class, [
                'entry_type' => CreditItemType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'label' => 'Positionen',
                'entry_options' => [
                    'label' => false,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Credit::class,
        ]);
    }
}
