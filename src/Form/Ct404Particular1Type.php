<?php

namespace App\Form;

use App\Entity\Ct404Particular;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Ct404Particular1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('address')
            ->add('zipCode')
            ->add('city')
            ->add('phoneNumber')
            ->add('pseudo')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('commercial')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ct404Particular::class,
        ]);
    }
}
