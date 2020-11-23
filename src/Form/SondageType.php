<?php

namespace App\Form;

use App\Entity\Sondage;
use App\Entity\Question;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SondageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('titre',TextType::class,['attr'=>
            ['placeholder'=>'entrer le titre du sondage'
                ,
                'style'=>'width:300px;margin-left:10px;height:25px;padding:12px'
                ,

                'class'=>'form-control']
            ])
            ->add('nbParticipant',TextType::class,['attr'=>
                ['placeholder'=>'entrer le nombre des participants maximal'
                    ,
                    'style'=>'width:300px;margin-left:10px;height:25px;padding:12px'
                    ,

                    'class'=>'form-control']

            ])
            //->add('nbQuestion')
           // ->add('nbReponse')
            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sondage::class,
        ]);
    }
}
