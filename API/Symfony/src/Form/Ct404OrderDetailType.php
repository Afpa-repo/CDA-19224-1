<?php

namespace App\Form;

use App\Entity\Ct404OrderDetail;
use App\Entity\Ct404Ordered;
use App\Entity\Ct404Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Ct404OrderDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', TextType::class)
            ->add('ordered', EntityType::class, [
                'class' => Ct404Ordered::class,
                'choice_label' => 'id',
            ])
            ->add('product', EntityType::class, [
                'class' => Ct404Product::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ct404OrderDetail::class,
        ]);
    }
}
