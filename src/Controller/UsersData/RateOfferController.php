<?php

namespace App\Controller\UsersData;

use App\Entity\CustomersRating;
use App\Entity\Reservation;
use App\Form\RateOfferType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RateOfferController extends AbstractController
{
    /**
     * @Route ("rateOffer/{reservationId}", name="rateOffer")
     *
     * @return Response
     */
    public function displayRateOfferForm(Request $request, int $reservationId): RedirectResponse|Response
    {
        if ((isset($_SESSION['display_rate_offer'][$reservationId]) && $_SESSION['display_rate_offer'][$reservationId] === true) || ! empty($request->request->all())) {
            $_SESSION['display_rate_offer'][$reservationId] = false;
            $reservation = $this->getDoctrine()->getRepository(Reservation::class)->find($reservationId);
            $offer = $reservation->getBookingOffer();
            $packageId = $offer->getPackageId();
            $customersRating = new CustomersRating();
            $customersRating->setPackage($packageId);
            $user = $this->getUser();
            $customersRating->setUser($user);
            $rateOfferForm = $this->createForm(RateOfferType::class, $customersRating);
            $rateOfferForm->handleRequest($request);
            if ($rateOfferForm->isSubmitted() && $rateOfferForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($customersRating);
                $em->flush();

                return $this->redirectToRoute('reservations');
            }

            return $this->render('reservations/rateOffer.html.twig', [
                'offer' => $offer,
                'rateOfferForm' => $rateOfferForm,
            ]);
        }

        return $this->redirectToRoute('reservations');
    }
}
