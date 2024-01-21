<?php

namespace App\Controller;

use App\Entity\Career;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CareerController extends AbstractController
{
    /**
     * @Route("/careers", name="careers")
     */
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        $em = $this->getDoctrine()->getManager();
        $careers = $em->getRepository(Career::class)->findAll();

        return $this->render('careers/index.html.twig', [
            'controller_name' => 'CareerController',
            'careers' => $careers,
        ]);
    }
}
