<?php

namespace App\Form;

use App\Entity\Ct404Professional;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Ct404Professional1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('siret')
            ->add('company')
            ->add('contact')
            ->add('companyEmail')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('commercial')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ct404Professional::class,
        ]);
    }
}
