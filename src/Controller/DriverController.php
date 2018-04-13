<?php

namespace App\Controller;

use App\Entity\Driver;
use App\Form\DriverType;
use App\Repository\DriverRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DriverController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var DriverRepository
     */
    private $driverRepository;

    public function __construct(EntityManagerInterface $entityManager, DriverRepository $driverRepository)
    {
        $this->entityManager = $entityManager;
        $this->driverRepository = $driverRepository;
    }

    /**
     * @Route("/driver", name="driver")
     */
    public function index()
    {
        $drivers = $this->driverRepository->findAll();
        return $this->render('driver/index.html.twig', [
            'controller_name' => 'DriverController',
            'drivers' => $drivers
        ]);
    }

    /**
     * @Route("/driver/create", name="driver.create")
     */
    public function create(Request $request)
    {
        $driver = new Driver();
        $form = $this->createForm(DriverType::class, $driver);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->entityManager->persist($data);
            $this->entityManager->flush();
        }
        return $this->render('driver/create.html.twig', ['form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/driver/{id}/edit", name="driver.edit")
     */
    public function edit($id, Request $request)
    {
        $driver = $this->driverRepository->find($id);
        if ($driver === null) {
            throw $this->createNotFoundException("Driver #{$id} does not exist.");
        }

        $form = $this->createForm(DriverType::class, $driver);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Driver $data */
            $data = $form->getData();

            $this->entityManager->persist($data);
            $this->entityManager->flush();

            return $this->redirect('/driver');
        }

        return $this->render('driver/create.html.twig', ['form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/driver/{id}/delete", name="driver.delete")
     */
    public function delete($id)
    {
        $driver = $this->driverRepository->find($id);
        $this->entityManager->remove($driver);
        $this->entityManager->flush();
        return $this->redirect('/driver');
    }

}
