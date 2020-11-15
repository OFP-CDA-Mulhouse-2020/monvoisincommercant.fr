<?php


namespace App\Form;


use App\Entity\MerchantCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class merchantformType extends AbstractType
{
    public function buildForm ( FormBuilderInterface $builder , array $options )
    {
        $builder
            ->add ('name')
            ->add ('firstname')
            ->add ('shopname')
            ->add ('category',EntityType::class,[
                'class' => MerchantCategory::class,
                'choice_label' => 'label'
            ])
            ->add ('adress',TextType::class, [
                'help' => 'exemple: 55 Rue de Pfastatt 68200 mulhouse',
                'mapped' => false
            ])
            ->add ('street', HiddenType::class)
            ->add ('streetnumber', HiddenType::class)
            ->add ('codepostal', HiddenType::class)
            ->add ('city', HiddenType::class)
            ->add('cordonneX', HiddenType::class)
            ->add('cordonneY', HiddenType::class)
            ->add ('phone')
            ->add ('email')
            ->add ('website')
            ->add ('description');
    }

}
