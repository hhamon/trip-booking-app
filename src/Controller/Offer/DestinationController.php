<?php

namespace App\Controller\Offer;

use App\Repository\DestinationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DestinationController extends AbstractController
{
    public function __construct(
        private readonly DestinationRepository $destinationRepository,
    ) {
    }

    #[Route(path: '/destinations', name: 'destinations')]
    public function index(): Response
    {
        return $this->render('destination/index.html.twig', [
            'destinations' => $this->destinationRepository->findAll(),
        ]);
    }
}
