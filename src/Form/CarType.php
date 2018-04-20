<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Driver;
use App\Repository\CarRepository;
use App\Repository\DriverRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    private $carRepository;
    /**
     * @var DriverRepository
     */
    private $driverRepository;

    public function __construct(CarRepository $carRepository, DriverRepository $driverRepository)
    {
        $this->carRepository = $carRepository;
        $this->driverRepository = $driverRepository;
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
            ->add('drivers', EntityType::class, [
                'class' => Driver::class, 'by_reference' => false, 'choice_label' => "name", 'multiple' => true, 'choices' => $this->driverRepository->findAll()
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
