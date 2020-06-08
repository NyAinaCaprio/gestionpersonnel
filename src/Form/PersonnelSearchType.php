<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Detache;
use App\Entity\Detachement;
use App\Entity\EtsouService;
use App\Entity\PersonnelSearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnelSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomprenom', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom ou Prénoms...']])
            ->add('etsouservice', EntityType::class, [
                'required'=> false,
                'choice_label' => 'etsouservice',
                'class' => EtsouService::class,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Ets ou Service...']
            ])
            ->add('categorie', EntityType::class,[
                'required'=> false,
                'choice_label' => 'categorie',
                'class' => Categorie::class,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Catégorie...']
            ])
            ->add('detachement', EntityType::class,[
                'required'=> false,
                'choice_label' => 'name',
                'class' => Detachement::class,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Détachement...']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonnelSearch::class,
            'method' => 'get', 
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
