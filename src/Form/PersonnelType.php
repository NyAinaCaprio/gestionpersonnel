<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Detachement;
use App\Entity\Direction;
use App\Entity\EtsouService;
use App\Entity\Personnel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('etsouservice', EntityType::class,[
                'class' => EtsouService::class,
                'choice_label' => 'etsouservice',
                'required' => false,

            ])
            ->add('categorie', EntityType::class,[
                'class' => Categorie::class,
                'choice_label' => 'categorie',
                'required'=> false
            ])
            ->add('detachement', EntityType::class, [
                'class' => Detachement::class,
                'choice_label' => 'name',
                'required' => false
            ])
            ->add('direction', EntityType::class,[
                'class' => Direction::class,
                'choice_label' => 'name',
                'required' => false
            ])
            ->add('imageFile', FileType::class,[
                'required' => false
            ])
            ->add('nomprenom' , TextType::class,[

            ])
            ->add('sexe', ChoiceType::class,[
                'choices' => [
                    'M' => 'Masculin',
                    'F' => 'Feminin',
                ]
            ])
            ->add('cin')
            ->add('delivrele', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',

            ] )
            ->add('a')
            ->add('adresseactuelle')
            ->add('adresseMail', TextType::class, [
                'required' => false

            ])
            ->add('situationmatrimoniale', ChoiceType::class,[
                'choices'  => [
                    'Marié' => 'Marié',
                    'Veuf(ve)' => 'Veuf(ve)',
                    'Célibataire' => 'Célibataire'
                ]])
            ->add('groupesanguin', TextType::class, [
                'required' => false
            ])
            ->add('groupeethnique', ChoiceType::class, [
                'choices'  => [
                    '' => '',
                    'Protestant' => 'Protestant',
                    'Catholique' => 'Catholique',
                    'Musulman' => 'Catholique',
                    'Autres' => 'Autres']])
            ->add('religion', ChoiceType::class, [
                'choices'  => [
                    '' => '',
                    'Protestant' => 'Protestant',
                    'Catholique' => 'Catholique',
                    'Musulman' => 'Catholique',
                    'Autres' => 'Autres']])
            ->add('telephone')
            ->add('lieu')
            ->add('datenaisse', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',

            ])
            ->add('affectionactuelle')
            ->add('matricule')
            ->add('fonction')
            ->add('daterecrute', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',

            ])
            ->add('indice')
            ->add('interruptiondu', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'required' => false

            ])
            ->add('au', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'required' => false

            ])
            ->add('sortantecole', TextType::class, [
                'required' => false
            ])
            ->add('rupture', ChoiceType::class, [
                'choices'  => [
                    'En activité' => 'En activité',
                    'RESILIATION  CONTRAT' => 'RESILIATION  CONTRAT',
                    'LICENCIEMENT' => 'LICENCIEMENT',
                    'DECEDE' => 'DECEDE',
                    'RETRAITE' => 'RETRAITE',
                ]
            ])
            ->add('nomconjoint', TextType::class, [
                'required' => false
            ])
            ->add('datemariage', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'required' => false

            ])
            ->add('dateNaissConj', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'required' => false

            ])
            ->add('lieuNaissConj', TextType::class, [
                'required' => false
            ])
            ->add('bureautique', CheckboxType::class, [
                'required' => false
            ])
            ->add('autres', TextareaType::class, [
                'required' => false
            ])
            ->add('francais', ChoiceType::class, [
                'choices'  => [
                    'Débutant' => 'Débutant',
                    'Moyen' => 'Moyen',
                    'Avancé' => 'Avancé',
                    ]])
            ->add('anglais', ChoiceType::class, [
                'choices'  => [
                    'Débutant' => 'Débutant',
                    'Moyen' => 'Moyen',
                    'Avancé' => 'Avancé',
                ]])
            ->add('autresLangue', TextareaType::class, [
                'required' => false
            ])
            ->add('NumPermis', TextType::class, [
                'required' => false
            ])
            ->add('permisDelivrele', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'required' => false

            ])
            ->add('lieuDelivrance', TextType::class, [
                'required' => false
            ])
            ->add('permisCategorie', TextType::class, [
                'required' => false
            ])
            ->add('autresPermis', TextareaType::class, [
                'required' => false
            ])
            ->add('affectationsuccessive', CollectionType::class,[
                'entry_type' => AffectationSuccessiveType::class,
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => false
            ])


            ->add('enfant', CollectionType::class,[
                'entry_type' => EnfantType::class,
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => false
            ])
            ->add('ecole', CollectionType::class,[
                'entry_type' => EcoleType::class,
                'entry_options' => [
                    'label' => false
                ],
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => false
            ])

            ->add('avancement', CollectionType::class,[
                'entry_type' => AvancementType::class,
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => false
            ])
            ->add('decoration', CollectionType::class, [
                'entry_type' => DecorationType::class,
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnel::class,
            'translation_domain' => 'forms'
        ]);
    }
}
