<?php

namespace App\Controller\Offer;

use App\Entity\Destination;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DestinationController extends AbstractController
{
    /**
     * @Route("/destinations", name="destinations")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $destinations = $em->getRepository(Destination::class)->findAll();

        return $this->render('destination/index.html.twig', [
            'controller_name' => 'DestinationController',
            'destinations' => $destinations,
        ]);
    }
}
