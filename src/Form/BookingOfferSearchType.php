<?php

namespace App\Form;

use App\Entity\BookingOffer;
use App\Entity\Destination;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingOfferSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('departureDate', TextType::class, [
                'attr' => [
                    'class' => 'form-control datepicker',
                    'placeholder' => 'Depart Date',
                ],
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'required' => false,
            ])
            ->add('comebackDate', TextType::class, [
                'attr' => [
                    'class' => 'form-control datepicker',
                    'placeholder' => 'Return Date',
                ],
                'label_attr' => [
                    'class' => 'sr-only',
                ],
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
            ->add('submit', SubmitType::class, [
                'label' => false,
            ]);

        $builder->get('departureDate')->addModelTransformer(new CallbackTransformer(
            static function ($date) {
                if ($date != null) {
                    return $date->format('d/m/Y');
                }

                return null;
            },
            static function ($date): ?\DateTime {
                if ($date != null) {
                    $date = explode('/', $date);
                    $date = $date[2] . '/' . $date[1] . '/' . $date[0];

                    return new \DateTime($date);
                }

                return null;
            }
        ));
        $builder->get('comebackDate')->addModelTransformer(new CallbackTransformer(
            static function ($date) {
                if ($date != null) {
                    return $date->format('d/m/Y');
                }

                return null;
            },
            static function ($date): ?\DateTime {
                if ($date != null) {
                    $date = explode('/', $date);
                    $date = $date[2] . '/' . $date[1] . '/' . $date[0];

                    return new \DateTime($date);
                }

                return null;
            }
        ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookingOffer::class,
            'destinations' => null,
            'departureSpots' => null,
        ]);
    }
}
