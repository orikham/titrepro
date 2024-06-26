<?php

// src/Form/PicturesFormType.php

namespace App\Form;

use App\Entity\Pictures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PicturesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('covers', FileType::class, [
                'label' => 'couverture',
            ])

            ->add('befores', FileType::class, [
                'label' => 'avant',
            ])

            ->add('afters', FileType::class, [
                'label' => 'apres',
            ]);

            // ->add('title', TextType::class, [
            //     'label' => 'Titre de l\'image',
            // ])

            // ->add('type', TextType::class, [
            //     'label' => 'Type de l\'image',
            //     'required' => false,
            // ]);


            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pictures::class,
        ]);
    }
}
