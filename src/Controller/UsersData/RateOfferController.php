<?php

namespace App\Controller\UsersData;

use App\Entity\CustomersRating;
use App\Form\RateOfferType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RateOfferController extends AbstractController
{
    public function __construct(
        private readonly ReservationRepository $reservationRepository,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @Route("rateOffer/{reservationId}", name="rateOffer")
     *
     * @return Response
     */
    public function displayRateOfferForm(Request $request, int $reservationId)
    {
        if ((isset($_SESSION['display_rate_offer'][$reservationId]) && true === $_SESSION['display_rate_offer'][$reservationId]) || !empty($request->request->all())) {
            $_SESSION['display_rate_offer'][$reservationId] = false;
            $reservation = $this->reservationRepository->find($reservationId);
            $offer = $reservation->getBookingOffer();
            $packageId = $offer->getPackageId();
            $customersRating = new CustomersRating();
            $customersRating->setPackage($packageId);
            $user = $this->getUser();
            $customersRating->setUser($user);
            $rateOfferForm = $this->createForm(RateOfferType::class, $customersRating);
            $rateOfferForm->handleRequest($request);
            if ($rateOfferForm->isSubmitted() && $rateOfferForm->isValid()) {
                $this->entityManager->persist($customersRating);
                $this->entityManager->flush();

                return $this->redirectToRoute('reservations');
            }

            return $this->render('reservations/rateOffer.html.twig', [
                'offer' => $offer,
                'rateOfferForm' => $rateOfferForm,
            ]);
        } else {
            return $this->redirectToRoute('reservations');
        }
    }
}
