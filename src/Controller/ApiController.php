<?php

namespace App\Controller;


use App\Repository\MerchantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function json_encode;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/points/nearest", name="api")
     */
    public function index(MerchantRepository $repository , Request $request): Response
    {
        $long = $request->get('long');
        $lat = $request->get('lat');

        return $this->json($repository->findAllNearestFrom($lat,$long));
    }



}
