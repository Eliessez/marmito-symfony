<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Recette;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('slug')
            ->add('time')
            ->add('nombre_personne')
            ->add('difficult')
            ->add('liste')
            ->add('prix')
            ->add('favoris')
            ->add('ingredients', EntityType::class,
            ['class'=> Ingredient::class,
            'choice_label'=>'nom',
            'multiple'=> true,
            'expanded'=>true])
            ->add('picture', FileType::class, [
                'label' => 'Image (JPG or PNG file)',
                'mapped' => false,
                'required' => false])
            // ->add('createdAt', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('updateAt', null, [
            //     'widget' => 'single_text',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
