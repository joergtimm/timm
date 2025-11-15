<?php

namespace App\Form;

use App\Entity\CreditItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreditItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('position', IntegerType::class, [
                'required' => false,
                'label' => 'Position',
            ])
            ->add('name', TextType::class, [
                'required' => false,
                'label' => 'Bezeichnung',
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Beschreibung',
                'attr' => ['rows' => 2],
            ])
            ->add('quantity', NumberType::class, [
                'required' => false,
                'label' => 'Menge',
                'scale' => 2,
            ])
            ->add('unit', TextType::class, [
                'required' => false,
                'label' => 'Einheit',
            ])
            ->add('unitNetPrice', IntegerType::class, [
                'required' => false,
                'label' => 'Einzelpreis (netto, Cent)',
            ])
            ->add('taxRate', IntegerType::class, [
                'required' => false,
                'label' => 'Steuersatz (%)',
            ])
            ->add('taxAmount', IntegerType::class, [
                'required' => false,
                'label' => 'Steuer (Cent)',
            ])
            ->add('unitGrossPrice', IntegerType::class, [
                'required' => false,
                'label' => 'Einzelpreis (brutto, Cent)',
            ])
            ->add('totalNet', IntegerType::class, [
                'required' => false,
                'label' => 'Summe netto (Cent)',
            ])
            ->add('totalTax', IntegerType::class, [
                'required' => false,
                'label' => 'Summe Steuer (Cent)',
            ])
            ->add('totalGross', IntegerType::class, [
                'required' => false,
                'label' => 'Summe brutto (Cent)',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreditItem::class,
        ]);
    }
}
