<?php

namespace App\Form;

use App\Entity\Car;
use App\Repository\CarRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    private $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('make')
            ->add('model')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Diesel' => Car::DIESEL,
                    'Bensin' => Car::BENSIN,
                    'Hybrid' => Car::HYBRID,
                    'Electric' => Car::ELECTRIC,
                ]
            ])
            ->add('save', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
