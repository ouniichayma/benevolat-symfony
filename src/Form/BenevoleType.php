<?php

namespace App\Form;

use App\Entity\Benevole;
use App\Entity\Mission;
use App\Entity\Zone;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BenevoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('numtel')
            ->add('adresse')
            ->add('email')
            ->add('motPasse')
            ->add('prenom')
            ->add('dateNaissance')
            ->add('experience')
            ->add('skills')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Benevole::class,
        ]);
    }
}
