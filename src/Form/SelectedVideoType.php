<?php

namespace App\Form;

use App\Entity\SelectedVideo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class SelectedVideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('videoId', HiddenType::class)
            ->add('title', HiddenType::class)
            ->add('thumbnailUrl', HiddenType::class)
            ->add('publishedAt', HiddenType::class, [
                'mapped' => false, // Ne pas mapper ce champ à l'entité
                'attr' => ['value' => $options['publishedAt_hidden'] ?? null], // Définir la valeur à partir de l'option
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SelectedVideo::class,
            'publishedAt_hidden' => null, // Ajoute une option pour passer la valeur de publishedAt
        ]);
    }
}
