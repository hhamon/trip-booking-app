<?php

namespace App\Controller\UsersData;

use App\Entity\CustomersRating;
use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route(path: '/reservations', name: 'reservations')]
    public function index()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $reservations = $em->getRepository(Reservation::class)->findReservationsByUser($user);

        $session_array = [];
        $isRatingAvailable = [];
        foreach ($reservations as $reservation) {
            $offer = $reservation->getBookingOffer();
            $offerComebackDate = $offer->getComebackDate()->format('Y-m-d');
            $packageId = $offer->getPackageId();
            $isOfferRated = $em->getRepository(CustomersRating::class)->findIfOfferIsRated($user, $packageId);
            if (! $isOfferRated and $offerComebackDate < date('Y-m-d')) {
                $isRatingAvailable[] = true;
                $session_array[$reservation->getId()] = true;
            } else {
                $isRatingAvailable[] = false;
                $session_array[$reservation->getId()] = false;
            }
        }
        $_SESSION['display_rate_offer'] = $session_array;

        return $this->render('reservations/index.html.twig', [
            'controller_name' => 'ReservationController',
            'reservations' => $reservations,
            'isRatingAvailable' => $isRatingAvailable,
        ]);
    }
}
