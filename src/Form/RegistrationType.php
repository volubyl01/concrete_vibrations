<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, [
                'label' => 'Adresse e-mail'
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent correspondre.',
                'required' => true,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmer le mot de passe'],
            ])
            ->add('user_name')
            ->add('user_instr')
            ->add('story')
            ->add('profile_picture')
            ->add('createdAt', null, [
                'widget' => 'single_text',
                'attr' => ['readonly' => true], // Rend le champ non modifiable
            ])
            ->add('roles', EntityType::class, [
                'class' => Role::class,
                
                'choice_label' => 'nameRole',
                // le champ accepte plusieurs choix
                'multiple' => true,
                // génére des cases à cocher plutôt qu'une liste déroulante
                'expanded' => true,
                // by_reference => false permet d'utiliser les méthode addrole et remove role plutôt que de remplacer toute la collection
                'by_reference' => false,
                'property_path' => 'rolesCollection' // utilise getrolescollection() et setrolescollection pour gérer la collection de roles
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
