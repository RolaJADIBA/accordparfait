<?php

namespace App\Form;

use App\Entity\Jardin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JardinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description',TextareaType::class,[
                'attr' => ['class' => 'form-control mb-3']
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
            'data_class' => Jardin::class,
        ]);
    }
}
