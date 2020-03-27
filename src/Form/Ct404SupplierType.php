<?php

namespace App\Form;

use App\Entity\Ct404Supplier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Ct404SupplierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('supplierName')
            ->add('supplierAddress')
            ->add('supplierCity')
            ->add('supplierZipeCode')
            ->add('supplierPhone')
            ->add('supplierMail')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ct404Supplier::class,
        ]);
    }
}
