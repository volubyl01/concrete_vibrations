<?php

namespace App\Form;

use App\Entity\Instrument;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InstrumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('manufacturer')
            ->add('type_instr')
            ->add('name_instr')
            ->add('picture_url')
            ->add('year_instr')
            ->add('oscillators')
            ->add('envelopes')
            ->add('filter_instr')
            ->add('lfos')
            ->add('polyphony')
            ->add('multitimbral')
            ->add('isApproved')
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
