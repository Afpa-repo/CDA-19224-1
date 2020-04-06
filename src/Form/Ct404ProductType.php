<?php

namespace App\Form;

use App\Entity\Ct404Category;
use App\Entity\Ct404OrderDetail;
use App\Entity\Ct404Product;
use App\Entity\Ct404Supplier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Ct404ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('price', MoneyType::class)
            ->add('stockQuantity', TextType::class)
            ->add('alertQuantity', TextType::class)
            ->add('category', EntityType::class, [
                'class' => Ct404Category::class,
                'choice_label' => 'name',
            ])
            ->add('supplier', EntityType::class, [
                'class' => Ct404Supplier::class,
                'choice_label' => 'name',
            ])
            ->add('orderDetail', EntityType::class, [
                'class' => Ct404OrderDetail::class,
                'choice_label' => 'if',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ct404Product::class,
        ]);
    }
}
