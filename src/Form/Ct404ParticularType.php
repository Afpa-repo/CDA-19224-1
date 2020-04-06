<?php

namespace App\Form;

use App\Entity\Ct404Commercial;
use App\Entity\Ct404Particular;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Ct404ParticularType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('address', TextType::class)
            ->add('zipCode', NumberType::class)
            ->add('city', TextType::class)
            ->add('phoneNumber', TextType::class)
            ->add('pseudo', TextType::class)
            ->add('commercial', EntityType::class, [
                'class' => Ct404Commercial::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ct404Particular::class,
        ]);
    }
}
