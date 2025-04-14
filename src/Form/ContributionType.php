<?php

namespace App\Form;

use App\Entity\Contribution;
use App\Entity\Instrument;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContributionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('style')
            ->add('type_contribution')
            ->add('upload')
            ->add('external_url')
            ->add('image_url')
            ->add('bpm')
            ->add('format')
            ->add('key_contrib')
            ->add('duration')
            ->add('description')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('isApproved')
            ->add('instrument', EntityType::class, [
                'class' => Instrument::class,
                'choice_label' => 'id',
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
            'data_class' => Contribution::class,
        ]);
    }
}
