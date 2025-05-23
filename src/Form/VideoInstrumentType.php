<?php

namespace App\Form;

use App\Entity\Instrument;
use App\Entity\SelectedVideo;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class VideoInstrumentType extends AbstractType
{
    
    
    private $security;

        public function __construct(Security $security)
        {
            $this->security = $security;
        }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $user = $options['user'] ?? $this->security->getUser();


        $builder
            ->add('selectedvideo', HiddenType::class, [
                // 'class' => SelectedVideo::class,
                // 'choice_label' => 'title',
                // 'placeholder' => 'Sélectionnez une vidéo',
                // ces options sont impossibles avec le champ hiddentype
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez sélectionner une vidéo.']),
                ],
               
            ])
            ->add('instrument', HiddenType::class, [
                // 'class' => Instrument::class,
                // 'choice_label' => 'nameInstr',
                // 'label' => 'Instrument',
                // 'placeholder' => 'Sélectionnez un instrument',
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez sélectionner un instrument.']),
                ],
               
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           // les entités sont indépendantes
        //    'data_class' => null,
        //    'csrf_protection' => true,
           'user' => null, // Ajout de l'option 'user'
        ]);
    }
}
