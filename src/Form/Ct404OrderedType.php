<?php

namespace App\Form;

use App\Entity\Ct404Ordered;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Ct404OrderedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('orderDate')
            ->add('deliveryDate')
            ->add('totalPrice')
            ->add('idCt404Commercial')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ct404Ordered::class,
        ]);
    }
}
