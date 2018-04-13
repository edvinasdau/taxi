<?php

namespace App\Controller;

use App\Entity\Trip;
use App\Form\TripType;
use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TripController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var TripRepository
     */
    private $tripRepository;

    public function __construct(EntityManagerInterface $entityManager, TripRepository $tripRepository)
    {
        $this->entityManager = $entityManager;
        $this->tripRepository = $tripRepository;
    }

    /**
     * @Route("/trip", name="trip")
     */
    public function index()
    {
        $trips = $this->tripRepository->findAll();
        return $this->render('trip/index.html.twig', [
            'controller_name' => 'TripController',
            'trips' => $trips
        ]);
    }

    /**
     * @Route("/trip/create", name="trip.create")
     */
    public function create(Request $request)
    {
        $trip = new Trip();
        $form = $this->createForm(TripType::class, $trip);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->entityManager->persist($data);
            $this->entityManager->flush();
        }
        return $this->render('trip/create.html.twig', ['form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/trip/{id}/edit", name="trip.edit")
     */
    public function edit($id, Request $request)
    {
        $trip = $this->tripRepository->find($id);
        if ($trip === null) {
            throw $this->createNotFoundException("Trip #{$id} does not exist.");
        }

        $form = $this->createForm(TripType::class, $trip);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Trip $data */
            $data = $form->getData();

            $this->entityManager->persist($data);
            $this->entityManager->flush();

            return $this->redirect('/trip');
        }

        return $this->render('trip/create.html.twig', ['form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/trip/{id}/delete", name="trip.delete")
     */
    public function delete($id)
    {
        $trip = $this->tripRepository->find($id);
        $this->entityManager->remove($trip);
        $this->entityManager->flush();
        return $this->redirect('/trip');
    }

}
