<?php

namespace App\Controller;

use App\DependencyInjection\AdresseLocator;
use App\Repository\LocalizedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function explode;

class LocalizeController extends AbstractController
{
    /**
     * @Route("/localize", name="localize")
     */
    public function index(AdresseLocator $locator): Response
    {
        $data1 = $locator->localize("15 rue de l'Oberfeld" , "68760" , "WILLER SUR THUR");
        $data2 = $locator->localize("55 rue de Pfastatt" , "68200" , "MULHOUSE");

        return $this->render('localize/index.html.twig', [
            'controller_name' => 'LocalizeController',
            'data1' => $data1,
            'data2' => $data2,
        ]);
    }

    /**
     * @Route ("/nearest/from/{town}")
     * @Route ("/nearest/from/{longitude}/{latitude}")
     */
    public function findNearestFrom(LocalizedRepository $repository , $town)
    {
        $towns = [
            'pulversheim' => "47.8407752 7.2929497",
            'kruth' => "47.9502167 6.944708",
            'wattwiller' => "47.8417896 7.15898",
            'moosch'=> "47.8483332 7.0125271"
            //47.8162682,7.0517203
        ];

        list($latitude, $longitude) = explode(" ",$towns[$town]);

        $values = $repository->findNearestFrom($latitude, $longitude);

        dd($values);
    }
}
