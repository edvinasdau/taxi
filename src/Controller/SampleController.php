<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SampleController extends Controller
{
    /**
     * @Route("/sample2", name="sample2")
     */
    public function index()
    {
        return $this->render('sample/index.html.twig', [
            'controller_name' => 'SampleController',
        ]);
    }

    public function index2()
    {
        return $this->render('sample2/index.html.twig', [
            'controller_name' => 'SampleController',
        ]);
    }
}
