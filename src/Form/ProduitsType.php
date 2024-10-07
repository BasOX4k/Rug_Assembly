<?php

namespace App\Form;

use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nom du produit']
            ])
            ->add('description', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Description du produit']
            ])
            ->add('image', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Lien de l\'image']
            ])
            ->add('prix', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Prix du produit']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
