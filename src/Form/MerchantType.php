<?php

namespace App\Form;

use App\Entity\Merchant;
use App\Entity\MerchantCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MerchantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name' , null , [
                'label' => "Nom du responsable"
            ])
            ->add('firstname', null , [
                'label' => "Prénom du responsable"
            ])
            ->add('shopName', null , [
                'label' => "Nom du magasin"
            ])
            ->add('category' , EntityType::class , [
                'class' => MerchantCategory::class,
                'choice_label' => 'label',
                'label' => "Catégorie de produits / services"
            ])
            ->add ('adress',TextType::class, [
                'help' => 'exemple: 55 Rue de Pfastatt 68200 mulhouse',
                'mapped' => false,
                'label' => "Adresse complète"
            ])
            ->add('street',HiddenType::class)
            ->add('streetNumber', HiddenType::class)
            ->add('code_postal' ,HiddenType::class)
            ->add('city',HiddenType::class)
            ->add('phone', null , [
                'label' => "Téléphone"
            ])
            ->add('email', null , [
                'label' => "Adresse Email"
            ])
            ->add('website', null , [
                'label' => "Site internet"
            ])
            ->add('description', TextareaType::class , [
                'attr' => [
                    'rows' => 10
                ],
                'label' => "Description des produits et services proposés"
            ])
            ->add('longitude',HiddenType::class)
            ->add('latitude',HiddenType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Merchant::class,
        ]);
    }
}
