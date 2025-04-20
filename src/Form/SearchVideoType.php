<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchVideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('query', TextType::class, [
                'label' => 'Recherche',
                'required' => true,
            ])
            ->add('region_code', ChoiceType::class, [
                'label' => 'Code région (ex: FR)',
                'required' => false,
                'choices' => [
                    'fr' => 'France',
                    'us' => 'USA',
                ],
            ])
            ->add('video_category_id', ChoiceType::class, [
                'label' => 'Catégorie (optionnelle)',
                'required' => false,
                'choices' => [
                    '10' => 'Musique',
                    '17' => 'Sport',
                    '20' => 'Jeux',
                ],
            ])
            ->add('max_results', IntegerType::class, [
                'label' => 'Nombre de résultats',
                'required' => false,
                'data' => 10,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'youtube_search_item',
        ]);
    }
}
