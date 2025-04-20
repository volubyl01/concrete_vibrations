<?php

namespace App\Form;


use App\Entity\User;
use App\Entity\Instrument;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class InstrumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('manufacturer')
            ->add('type_instr', TextType::class)
            ->add('name_instr', TextType::class, [
                'label' => 'Nom de l\'instrument',
            ])
            ->add('picture_url', TextType::class, [
                'label' => 'URL de l\'image',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'attr' => ['rows' => 5],
            ])
            ->add('year_instr', IntegerType::class, [
                'label' => 'Année de sortie',
            ])
            ->add('oscillators', IntegerType::class, [
                'label' => 'Nombre d\'oscillateurs',
            ])
            ->add('filter_instr', IntegerType::class, [
                'label' => 'Nombre de filtres',
            ])
            ->add('envelopes', TextType::class, [
                'label' => 'Nombre d\'enveloppes',
            ]) 
            ->add('filter_instr', IntegerType::class, [
                'label' => 'Type de filtre',
            ])
            ->add('lfos', IntegerType::class, [
                'label' => 'Nombre de LFOs',
            ])
            ->add('polyphony', TextType::class, [
                'label' => 'Polyphonie',
            ])
          
            ->add('multitimbral', TextType::class, [
                'label' => 'Multitimbral',
            ])
            ->add('isApproved', CheckboxType::class, [
                'label' => 'Approuvé',
                'required' => false,
            ])
            ->add('synthesis_type')
            ->add('rating')
            ->add('review_count')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Instrument::class,
        ]);
    }
}
