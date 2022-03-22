<?php

namespace App\Form;

use App\Entity\Stages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\EntrepriseType;
use App\Entity\Formations;


class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('descMission')
            ->add('email')
            ->add('entreprise', EntrepriseType::class)
            ->add('formations', EntityType::class, array(
                'class' => Formations::class,
            
                'choice_label' => 'nom',
            
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
            ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stages::class,
        ]);
    }
}
