<?php

namespace App\Controller\UsersData;

use App\Entity\User;
use App\Repository\CustomersRatingRepository;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ReservationController extends AbstractController
{
    public function __construct(
        private readonly CustomersRatingRepository $customersRatingRepository,
        private readonly ReservationRepository $reservationRepository,
    ) {
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/reservations', name: 'reservations')]
    public function index(Request $request, #[CurrentUser] User $user): Response
    {
        $reservations = $this->reservationRepository->findReservationsByUser($user);

        $session_array = [];
        $isRatingAvailable = [];
        foreach ($reservations as $reservation) {
            $offer = $reservation->getBookingOffer();
            $offerComebackDate = $offer->getComebackDate()->format('Y-m-d');
            $packageId = $offer->getPackageId();
            $isOfferRated = $this->customersRatingRepository->findIfOfferIsRated($user, $packageId);
            if (!$isOfferRated and $offerComebackDate < date('Y-m-d')) {
                $isRatingAvailable[] = true;
                $session_array[$reservation->getId()] = true;
            } else {
                $isRatingAvailable[] = false;
                $session_array[$reservation->getId()] = false;
            }
        }

        $session = $request->getSession();
        $session->set('display_rate_offer', $session_array);

        return $this->render('reservations/index.html.twig', [
            'controller_name' => 'ReservationController',
            'reservations' => $reservations,
            'isRatingAvailable' => $isRatingAvailable,
        ]);
    }
}
