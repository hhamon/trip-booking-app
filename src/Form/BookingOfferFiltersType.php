<?php

namespace App\Form;

use App\Entity\BookingOffer;
use App\Entity\BookingOfferType;
use App\Entity\Destination;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingOfferFiltersType extends AbstractType
{
    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('priceMin', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Min',
                ],
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'label' => 'Minimum Price',
                'mapped' => false,
                'required' => false,
            ])
            ->add('priceMax', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Max',
                ],
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'label' => 'Maximum Price',
                'mapped' => false,
                'required' => false,
            ])
            ->add('departureDate', TextType::class, [
                'attr' => [
                    'class' => 'form-control datepicker',
                    'placeholder' => 'Depart',
                ],
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'empty_data' => null,
                'required' => false,
            ])
            ->add('comebackDate', TextType::class, [
                'attr' => [
                    'class' => 'form-control datepicker',
                    'placeholder' => 'Return',
                ],
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'empty_data' => null,
                'required' => false,
            ])
            ->add('departureSpot', ChoiceType::class, [
                'choices' => $options['departureSpots'],
                'placeholder' => 'From',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'required' => false,
            ])
            ->add('destination', EntityType::class, [
                'choices' => $options['destinations'],
                'class' => Destination::class,
                'attr' => [
                    'class' => 'form-control',
                ],
                'placeholder' => 'To',
                'label' => 'To',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'required' => false,
            ])
            ->add('offerTypes', EntityType::class, [
                'class' => BookingOfferType::class,
                'choices' => $options['offer_types'],
                'choice_attr' => fn () => ['class' => 'form-check-input'],
                'label_attr' => [
                    'class' => 'form-check-label',
                ],
                'expanded' => true,
                'multiple' => true,
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class)
            ->add('reset', ResetType::class)
        ;
        $builder->get('departureDate')->addModelTransformer(new CallbackTransformer(
            function ($date) {
                if (null != $date) {
                    return $date->format('d/m/Y');
                }

                return null;
            },
            function ($date) {
                if (null != $date) {
                    $date = explode('/', $date);
                    $date = $date[2].'/'.$date[1].'/'.$date[0];

                    return new \DateTime($date);
                }

                return null;
            }
        ));
        $builder->get('comebackDate')->addModelTransformer(new CallbackTransformer(
            function ($date) {
                if (null != $date) {
                    return $date->format('d/m/Y');
                }

                return null;
            },
            function ($date) {
                if (null != $date) {
                    $date = explode('/', $date);
                    $date = $date[2].'/'.$date[1].'/'.$date[0];

                    return new \DateTime($date);
                }

                return null;
            }
        ));
    }

    #[\Override]
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BookingOffer::class,
            'offer_types' => null,
            'destinations' => null,
            'departureSpots' => null,
        ]);
    }
}
