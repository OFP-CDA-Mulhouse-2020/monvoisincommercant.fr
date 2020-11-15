<?php

namespace App\Controller;


use App\Entity\Merchant;
use App\Form\merchantformType;
use CrEOF\Spatial\PHP\Types\Geometry\Point;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MerchantController extends AbstractController
{
    /**
     * @Route("/merchant", name="merchant")
     */
    public function index(): Response
    {
        return $this->render('merchant/index.html.twig', [
            'controller_name' => 'MerchantController',
        ]);
    }

    /**
     * @Route("/merchant/add"), name="merchant_add")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    public function new ( EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm (MerchantformType::class);

        $form->handleRequest ($request);
        if ($form->isSubmitted () && $form->isValid ()) {
            $data = $form->getData ();
            $lng =$data['cordonneX'];
            $lat =$data['cordonneY'];

            $point = new Point($lng,$lat,200);

            $merchant = new Merchant();
            $merchant->setName ($data['name']);
            $merchant->setFirstname ($data['firstname']);
            $merchant->setShopName ($data['shopname']);
            $merchant->setCategoryId ($data['category']);
            $merchant->setStreet ($data['street']);
            $merchant->setStreetNumber ($data['streetnumber']);
            $merchant->setCodePostal ($data['codepostal']);
            $merchant->setCity ($data['city']);
            $merchant->setPhone ($data['phone']);
            $merchant->setEmail ($data['email']);
            $merchant->setWebsit ($data['website']);
            $merchant->setDescription ($data['description']);
            $merchant->setCoords ($point);

            $em->persist ($merchant);
            $em->flush ();

            return $this->redirectToRoute ('merchant_add');
        }

        return $this->render ('merchant/new.html.twig',[
            'merchantForm' => $form->createView (),
        ]);
    }
}
