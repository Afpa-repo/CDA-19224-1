<?php

namespace App\Form;

use App\Entity\Ct404particular;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Ct404particularType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('address')
            ->add('zipCode')
            ->add('city')
            ->add('mail')
            ->add('phoneNumber')
            ->add('password')
            ->add('pseudo')
            ->add('clef')
            ->add('actif')
            ->add('dateRegisteur')
            ->add('idCt404Role')
            ->add('idCt404Commercial')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ct404particular::class,
        ]);
    }
}
