<?php

namespace App\Controller;

use App\Form\MerchantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function dd;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request): Response
    {
        $merchantForm = $this->createForm(MerchantType::class);

        $merchantForm->handleRequest ($request);

        if ($merchantForm->isSubmitted () && $merchantForm->isValid ()) {
            $data = $merchantForm->getData ();

            dd($data);

            //$em->persist ($merchant);
            //$em->flush ();

            //return $this->redirectToRoute ('merchant_add');
        }

        return $this->render('homepage/index.html.twig', [
            'merchantForm' => $merchantForm->createView(),
        ]);
    }
}
