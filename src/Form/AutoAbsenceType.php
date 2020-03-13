<?php

namespace App\Form;

use App\Entity\AutoAbsence;
use App\Entity\EtsouService;
use App\Entity\Personnel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AutoAbsenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('etsouservice', EntityType::class,[
            'class' => EtsouService::class,
            'choice_label' => 'etsouservice',
            'label' => 'Service',
            'disabled' => true
        ])
            ->add('motif', TextareaType::class)
            ->add('personnel', EntityType::class,[
                'class' => Personnel::class,
                'choice_label' => 'nomprenom',
                'disabled' => true
            ])
            ->add('seRendreA')
            ->add('heureDepart')
            ->add('heureArrive')
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'disabled' => true

            ] )

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AutoAbsence::class,
        ]);
    }
}
