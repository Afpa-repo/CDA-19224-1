<?php

namespace App\Form;

use App\Entity\Ct404Commercial;
use App\Entity\Ct404Ordered;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Ct404OrderedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('orderDate', DateTimeType::class)
            ->add('deliveryDate', DateTimeType::class)
            ->add('totalPrice', MoneyType::class)
            ->add('commercial', EntityType::class, [
                'class' => Ct404Commercial::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ct404Ordered::class,
        ]);
    }
}
