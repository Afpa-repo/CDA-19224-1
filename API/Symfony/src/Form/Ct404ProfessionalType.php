<?php

namespace App\Form;

use App\Entity\Ct404Commercial;
use App\Entity\Ct404Professional;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Ct404ProfessionalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('siret', TextType::class)
            ->add('company', TextType::class)
            ->add('contact', TextType::class)
            ->add('companyEmail', EmailType::class)
            ->add('commercial', EntityType::class, [
                'class' => Ct404Commercial::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ct404Professional::class,
        ]);
    }
}
