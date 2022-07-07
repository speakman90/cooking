<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Recettes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RecettesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        
        $builder
            ->add('title')
            ->add('slug')
            ->add('ingredient', TextareaType::class)
            ->add('image', FileType::class, [
            'allow_file_upload' => ['multipart/form-data'],
            'data_class' => null
            ])
            ->add('content', TextareaType::class)
            ->add('user', EntityType::class, [
                'label' => ' ',
                'class'=>User::class,
                'choice_value' => function (User $entity) {
                return $entity->getId();},
                'attr' => ['class' =>'form-author']
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recettes::class,
        ]);
    }
}
