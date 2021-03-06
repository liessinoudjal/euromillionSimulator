<?php

namespace AppBundle\Form;

use AppBundle\Entity\Grille;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class GrilleType extends AbstractType
{
    private $range = [
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 7,
        8 => 8,
        9 => 9,
        10 => 10,
        11 => 11,
        12 => 12,
        13 => 13,
        14 => 14,
        15 => 15,
        16 => 16,
        17 => 17,
        18 => 18,
        19 => 19,
        20 => 20,
        21 => 21,
        22 => 22,
        23 => 23,
        24 => 24,
        25 => 25,
        26 => 26,
        27 => 27,
        28 => 28,
        29 => 29,
        30 => 30,
        31 => 31,
        32 => 32,
        33 => 33,
        34 => 34,
        35 => 35,
        36 => 36,
        37 => 37,
        38 => 38,
        39 => 39,
        40 => 40,
        41 => 41,
        42 => 42,
        43 => 43,
        44 => 44,
        45 => 45,
        46 => 46,
        47 => 47,
        48 => 48,
        49 => 49,
        50 => 50
    ];

    private $range12 = [
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 7,
        8 => 8,
        9 => 9,
        10 => 10,
        11 => 11,
        12 => 12,

    ];

    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbTirage', ChoiceType::class, [
                'choices' => ['5 ans'=>5,'10 ans'=>10, '20 ans'=>20,'30 ans'=>30,'40 ans'=>40,'50 ans'=>50,'1000 ans'=>1000],
                'required' => true
            ])
            ->add('num1', ChoiceType::class, [
                'choices' => $this->range,
                'required' => false
            ])
            ->add('num2', ChoiceType::class
                , [
                    'choices' => $this->range,
                    'required' => false
                ])
            ->add('num3', ChoiceType::class
                , [
                    'choices' => $this->range,
                    'required' => false
                ])
            ->add('num4', ChoiceType::class
                , [
                    'choices' => $this->range,
                    'required' => false
                ])
            ->add('num5', ChoiceType::class
                , [
                    'choices' => $this->range,
                    'required' => false
                ])
            ->add('etoile1', ChoiceType::class
                , [
                    'choices' => $this->range12,
                    'required' => false
                ])
            ->add('etoile2', ChoiceType::class
                , [
                    'choices' => $this->range12,
                    'required' => false
                ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Grille',
        ));
    }


}