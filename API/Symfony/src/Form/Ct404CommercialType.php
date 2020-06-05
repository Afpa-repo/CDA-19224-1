<?php

namespace App\Form;

use App\Entity\Ct404Commercial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Ct404CommercialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('commercialForParticular', CheckboxType::class, [
                'label' => 'Commercial pour les particulier ?',
            ])
            ->add('commercialForProfessional', CheckboxType::class, [
                'label' => 'Commercial pour les professionels ?',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ct404Commercial::class,
        ]);
    }
}
