<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Client;
use App\Entity\Driver;
use App\Repository\CarRepository;
use App\Repository\ClientRepository;
use App\Repository\DriverRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripType extends AbstractType
{
    /**
     * @var DriverRepository
     */
    private $driverRepository;

    /**
     * @var CarRepository
     */
    private $carRepository;

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    public function __construct(CarRepository $carRepository, DriverRepository $driverRepository, ClientRepository $clientRepository)
    {
        $this->carRepository = $carRepository;
        $this->driverRepository = $driverRepository;
        $this->clientRepository = $clientRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('client', EntityType::class,
                [
                    'class' => Client::class, 'by_reference' => false, 'choice_label' => "name", 'choices' => $this->clientRepository->findAll()
                ])
            ->add('driver', EntityType::class,
                [
                    'class' => Driver::class, 'choice_label' => "name", 'choices' => $this->driverRepository->findAll()
                ])

            ->add('length')
            ->add('duration')
            ->add('cost')
            ->add('save', SubmitType::class);

  $formModifier = function (FormInterface $form, Driver $driver = null) {
      $positions = null === $driver ? array() : $driver->getCars();

      $form->add('car', EntityType::class, array(
          'class' => Car::class,
          'placeholder' => '',
          'choice_label' => 'make',
          'choices' => $positions,
      ));
  };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getDriver());
            }
        );

        $builder->get('driver')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {

                $driver = $event->getForm()->getData();

                $formModifier($event->getForm()->getParent(), $driver);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
