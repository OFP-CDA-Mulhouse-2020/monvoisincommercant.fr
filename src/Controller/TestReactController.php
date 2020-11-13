<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestReactController extends AbstractController
{
    /**
     * @Route("/test/react", name="test_react")
     */
    public function index(): Response
    {
        return $this->render('test_react/index.html.twig', [
            'controller_name' => 'TestReactController',
        ]);
    }
}
