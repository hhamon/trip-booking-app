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
     * @return Response
     */
    #[Route(path: 'rateOffer/{reservationId}', name: 'rateOffer')]
    public function displayRateOfferForm(Request $request, int $reservationId)
    {
        $session = $request->getSession();

        /** @var array<int, bool> $displayRateOffers */
        $displayRateOffers = $session->get('display_rate_offer', []);
        $displayRateOffer = $displayRateOffers[$reservationId] ?? false;

        if ($displayRateOffer || \count($request->request->all()) > 0) {
            $session->set('display_rate_offer', \array_merge($displayRateOffers, [$reservationId => false]));

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
