<?php

namespace App\Controller;

use App\Repository\CareerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CareerController extends AbstractController
{
    public function __construct(
        private readonly CareerRepository $careerRepository,
    ) {
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/careers', name: 'careers')]
    public function index(): Response
    {
        return $this->render('careers/index.html.twig', [
            'controller_name' => 'CareerController',
            'careers' => $this->careerRepository->findAll(),
        ]);
    }
}
