<?php


namespace App\Controller\UsersData;

use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\CustomersRating;
use App\Entity\BookingOffer;
use App\Form\RateOfferType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RateOfferController extends AbstractController
{
    /**
     * @Route ("rateOffer/{reservationId}", name="rateOffer")
     * @param Request $request
     * @param int $reservationId
     * @return Response
     */
    public function displayRateOfferForm(Request $request, int $reservationId)
    {
        if ((isset($_SESSION['display_rate_offer'][$reservationId]) && $_SESSION['display_rate_offer'][$reservationId] === TRUE) || !empty($request->request->all())){
            $_SESSION['display_rate_offer'][$reservationId] = FALSE;
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
                return $this->redirectToRoute("reservations");
            }
            return $this->render('reservations/rateOffer.html.twig', [
                'offer' => $offer,
                'rateOfferForm' => $rateOfferForm
            ]);
        } else {
            return $this->redirectToRoute("reservations");
        }
    }
}