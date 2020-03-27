<?php

namespace App\Form;

use App\Entity\Ct404Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Ct404ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productName')
            ->add('description')
            ->add('price')
            ->add('quantityStock')
            ->add('quantityOfAlerte')
            ->add('categoryName')
            ->add('idCt404Supplier')
            ->add('idct404Category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ct404Product::class,
        ]);
    }
}
