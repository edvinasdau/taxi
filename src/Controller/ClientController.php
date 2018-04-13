<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClientController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    public function __construct(EntityManagerInterface $entityManager, ClientRepository $clientRepository)
    {
        $this->entityManager = $entityManager;
        $this->clientRepository = $clientRepository;
    }

    /**
     * @Route("/client", name="client")
     */
    public function index()
    {
        $clients = $this->clientRepository->findAll();
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
            'clients' => $clients
        ]);
    }

    /**
     * @Route("/client/create", name="client.create")
     */
    public function create(Request $request)
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->entityManager->persist($data);
            $this->entityManager->flush();
        }
        return $this->render('client/create.html.twig', ['form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/client/{id}/edit", name="client.edit")
     */
    public function edit($id, Request $request)
    {
        $client = $this->clientRepository->find($id);
        if ($client === null) {
            throw $this->createNotFoundException("Client #{$id} does not exist.");
        }

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Client $data */
            $data = $form->getData();

            $this->entityManager->persist($data);
            $this->entityManager->flush();

            return $this->redirect('/client');
        }

        return $this->render('client/create.html.twig', ['form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/client/{id}/delete", name="client.delete")
     */
    public function delete($id)
    {
        $client = $this->clientRepository->find($id);
        $this->entityManager->remove($client);
        $this->entityManager->flush();
        return $this->redirect('/client');
    }

}
