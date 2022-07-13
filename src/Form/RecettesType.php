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
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RecettesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        
        $builder
            ->add('title', TextType::class, [
                'label'=> 'Titre de la recette'
                ])
            ->add('slug', HiddenType::class, [
                'data'=> 'ok'
            ])
            ->add('ingredient', TextareaType::class, [
                'label'=>'Ingrédient'
            ])
            ->add('image', FileType::class, [
            'label'=> "Image d'illustration de la recette",
            'allow_file_upload' => ['multipart/form-data'],
            'data_class' => null
            ])
            ->add('content', TextareaType::class, [
                'label'=>'Préparation de la recette'
            ])
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
