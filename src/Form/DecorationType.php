<?php

namespace App\Form;

use App\Entity\Decoration;
use App\Entity\ListeDeco;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DecorationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('listedeco', EntityType::class, [
                'class' => ListeDeco::class,
                'choice_label' => 'decoration',
                'required' => false
            ])
            ->add('decretouarrete', TextType::class, [
                'required' => false
            ])
            ->add('annee', IntegerType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Decoration::class,
        ]);
    }
}
