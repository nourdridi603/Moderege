<?php

namespace App\Form;

use App\Entity\Enqueteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnqueteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance')
            ->add('email')
            ->add('tel')
            ->add('motDePasse')
            ->add('matriculeFiscale')
            ->add('registreDesCommeerces')
            ->add('adresseSociete')
            ->add('logo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enqueteur::class,
        ]);
    }
}
