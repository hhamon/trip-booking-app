<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationStartType extends AbstractType
{
    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adultNumber', NumberType::class, [
                'data' => 2,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Number of adults',
                    'min' => 1,
                ],
                'html5' => true,
                'label' => 'Number of adults',
            ])
            ->add('childNumber', NumberType::class, [
                'data' => 0,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Number of children',
                    'min' => 0,
                ],
                'html5' => true,
                'label' => 'Number of children',
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    #[\Override]
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
