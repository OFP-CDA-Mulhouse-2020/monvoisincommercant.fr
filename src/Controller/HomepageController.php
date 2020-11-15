<?php

namespace App\Controller;

use App\Form\MerchantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        $merchantForm = $this->createForm(MerchantType::class);

        return $this->render('homepage/index.html.twig', [
            'merchantForm' => $merchantForm->createView(),
        ]);
    }
}
