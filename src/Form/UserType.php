<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'label' => 'Email',
            'required' => true,
        ])
            ->add('password')
            ->add('user_name')
            ->add('user_instr')
            ->add('story')
            ->add('profile_picture')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('roles', EntityType::class, [
                'class' => Role::class,
                'choice_label' => 'nameRole',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
                'property_path' => 'roleEntities'
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
