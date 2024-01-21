<?php

namespace App\Controller;

use App\Entity\BookingOffer;
use App\Form\BookingOfferSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $bookingOffer = new BookingOffer();
        $offers = $this->getDoctrine()->getRepository(BookingOffer::class)->findAll();
        foreach ($offers as $offer) {
            $departureSpots[$offer->getDepartureSpot()] = $offer->getDepartureSpot();
        }
        $form = $this->createForm(BookingOfferSearchType::class, $bookingOffer, [
            'attr' => [
                'class' => 'form-inline',
            ],
            'action' => $this->generateUrl('offer_browse'),
            'method' => 'GET',
            'departureSpots' => $departureSpots,
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->forward('App\Controller\Offer\OfferController::getOffers', [
               'departureSpot' => null,
               'destination' => $bookingOffer->getDestination(),
               'departureDate' => $bookingOffer->getDepartureDate(),
               'comebackDate' => $bookingOffer->getComebackDate(),
            ]);
        }
        $featuredOffers = $this->getDoctrine()->getRepository(BookingOffer::class)->findBy(['isFeatured' => 1]);
        $featuredWithRating = [];
        foreach ($featuredOffers as $featuredOffer) {
            $featuredWithRating[] = $this->getDoctrine()->getRepository(BookingOffer::class)->findOffer($featuredOffer->getId());
        }

        return $this->render('index/index.html.twig', [
            'form' => $form->createView(),
            'featuredOffers' => $featuredWithRating,
        ]);
    }
}
