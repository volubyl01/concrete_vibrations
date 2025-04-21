<?php

namespace App\Form;

use App\Data\InstrumentSearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class InstrumentSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('q', TextType::class, [
            'label' => 'Recherche',
            'required' => false,
        ])
        ->add('type_instr', ChoiceType::class, [
            'choices' => [
                'Synthétiseur' => 'synthétiseur',
                'Boite à rythmes' => 'boite à rythmes',
                'Groove Box' => 'groove box',
                'Sampleur' => 'sampleur',
                'Clavier maître' => 'clavier maître',
                'Workstation' => 'workstation',
                'Arrangeur' => 'arrangeur',
                'Expandeur' => 'expandeur',
            ],
            'placeholder' => 'Choisissez un type',
        ])
        ->add('year_min', IntegerType::class, [
            'label' => 'Année min',
            'required' => false,
        ])
        ->add('year_max', IntegerType::class, [
            'label' => 'Année max',
            'required' => false,
        ])
        ->add('polyphony', TextType::class, [
            'label' => 'Polyphonie',
            'required' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InstrumentSearchData::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
