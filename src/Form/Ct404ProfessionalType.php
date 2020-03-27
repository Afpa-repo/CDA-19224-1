<?php

namespace App\Form;

use App\Entity\Ct404Professional;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Ct404ProfessionalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('siretNumber')
            ->add('compagnyName')
            ->add('contactName')
            ->add('mail')
            ->add('dateRegister')
            ->add('clef')
            ->add('actif')
            ->add('password')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ct404Professional::class,
        ]);
    }
}
