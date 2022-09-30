<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom',TextType::class,[
                'attr' => ['class' => 'form-control mb-3'],
                'required' => false
            ])
            ->add('nom',TextType::class,[
                'attr' => ['class' => 'form-control mb-3'],
                'required' => false
            ])
            ->add('email',EmailType::class,[
                'attr' => ['class' => 'form-control mb-3'],
                'required' => false
            ])
            ->add('role',TextType::class,[
                'attr' => ['class' => 'form-control mb-3'],
                'required' => false
            ])
            ->add('photo',FileType::class,[
                'data_class' => null,
                'required' => false,
                'attr' => ['class' => 'mb-3']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
