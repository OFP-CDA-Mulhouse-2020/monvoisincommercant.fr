<?php

namespace App\Form;

use App\Entity\Localized;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestformType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label')
            ->add('coords')
            ->add('full_address' , TextType::class ,[
                'mapped' => false
            ])
            ->add('city' , HiddenType::class)
            ->add('zipcode' , HiddenType::class)
            ->add('street' , HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Localized::class,
        ]);
    }
}
