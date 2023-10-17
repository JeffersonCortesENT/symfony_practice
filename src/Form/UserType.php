<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\UserLevel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
              'constraints' => [
                new NotBlank(),
                new Length([
                  'min' => 20,
                  'max' => 100,
                ]),
              ]
            ])
            ->add('user_name', null, [
              'constraints' => [
                new NotBlank(),
                new Length([
                  'min' => 8,
                  'max' => 30,
                ]),
              ]
            ])
            ->add('password', null, [
              'constraints' => [
                new NotBlank(),
                new Length([
                  'min' => 8,
                  'max' => 20,
                ]),
              ]
            ])
            ->add('user_level', EntityType::class, [
                'class' => UserLevel::class,
                'choice_label' => 'level_code', // Display the 'level_code' property of UserLevel
                'placeholder' => 'Select user level',
                'required' => true,
                'choice_value' => 'id', // Use the 'id' property as the value
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
