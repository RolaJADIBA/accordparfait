<?php

namespace App\Form;

use App\Entity\Evenements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EvenementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class,[
                'attr' => ['class' => 'form-control mb-3'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un titre'
                    ])
                ]
            ])
            ->add('date', DateType::class,[
                'attr' => ['class' => 'mb-3'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un titre'
                    ])
                ]
            ])
            ->add('description', TextareaType::class,[
                'attr' => ['class' => 'form-control mb-3'],
                'required' => false
            ])
            ->add('image_choisi', FileType::class,[
                'data_class' => null,
                'required' => false,
                'attr' => ['class' => 'mb-3']

            ])
            ->add('images', FileType::class,[
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
            'data_class' => Evenements::class,
        ]);
    }
}
