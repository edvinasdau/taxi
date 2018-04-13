<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CarController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var CarRepository
     */
    private $carRepository;

    public function __construct(EntityManagerInterface $entityManager, CarRepository $carRepository)
    {
        $this->entityManager = $entityManager;
        $this->carRepository = $carRepository;
    }

    /**
     * @Route("/car", name="car")
     */
    public function index()
    {
        $cars = $this->carRepository->findAll();
        return $this->render('car/index.html.twig', [
            'controller_name' => 'CarController',
            'cars' => $cars
        ]);
    }

    /**
     * @Route("/car/create", name="car.create")
     */
    public function create(Request $request)
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->entityManager->persist($data);
            $this->entityManager->flush();
        }
        return $this->render('car/create.html.twig', ['form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/car/{id}/edit", name="car.edit")
     */
    public function edit($id, Request $request)
    {
        $car = $this->carRepository->find($id);
        if ($car === null) {
            throw $this->createNotFoundException("Car #{$id} does not exist.");
        }

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Car $data */
            $data = $form->getData();

            $this->entityManager->persist($data);
            $this->entityManager->flush();

            return $this->redirect('/car');
        }

        return $this->render('car/create.html.twig', ['form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/car/{id}/delete", name="car.delete")
     */
    public function delete($id)
    {
        $car = $this->carRepository->find($id);
        $this->entityManager->remove($car);
        $this->entityManager->flush();
        return $this->redirect('/car');
    }

}
