<?php

namespace App\Form;

use App\Entity\AffectationSuccessive;
use App\Entity\Detachement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AffectationSuccessiveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lieuaffect', TextType::class, [
                'required' => false
            ])
            ->add('detachement', TextType::class,[
                'required' => false,

            ])
            ->add('fonctiontenue', TextType::class, [
                'required' => false
            ])
            ->add('dateeffet', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AffectationSuccessive::class,
        ]);
    }
}
