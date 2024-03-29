<?php

namespace App\Form;

use App\Entity\Soutien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoutienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class,[
                'attr' => ['class' => 'form-control mb-3'],
                'required' => false
            ])
            ->add('description',TextareaType::class,[
                'attr' => ['class' => 'form-control mb-3'],
                'required' => false
            ])
            ->add('images',FileType::class,[
                'data_class' => null,
                'multiple' => true,
                'required' => false,
                'attr' => ['class' => 'mb-3']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Soutien::class,
        ]);
    }
}
