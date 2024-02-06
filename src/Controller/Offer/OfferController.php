<?php

namespace App\Controller\Offer;

use App\Entity\BookingOffer;
use App\Entity\Reservation;
use App\Entity\User;
use App\Form\BookingOfferFiltersType;
use App\Form\ConfirmReservationType;
use App\Form\ReservationStartType;
use App\Repository\BookingOfferRepository;
use App\Repository\BookingOfferTypeRepository;
use App\Repository\DestinationRepository;
use App\Service\BookingOfferService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[\Symfony\Component\Routing\Attribute\Route(path: '/offer', name: 'offer_')]
class OfferController extends AbstractController
{
    public function __construct(
        private readonly BookingOfferRepository $bookingOfferRepository,
        private readonly BookingOfferTypeRepository $bookingOfferTypeRepository,
        private readonly DestinationRepository $destinationRepository,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @throws \Exception
     */
    #[\Symfony\Component\Routing\Attribute\Route(path: '/browse', name: 'browse')]
    public function displayOfferList(Request $request, BookingOfferService $offerService): Response
    {
        $bookingOffer = new BookingOffer();
        if ($request->query->get('booking_offer_search')) {
            $offers = $this->getOffersBasedOnRequestQuery($offerService, $request, $bookingOffer);
        } elseif ($request->query->get('offerType')) {
            $offers = $this->getOffersBasedOnOfferType($offerService, $request->query->get('offerType'));
        } elseif ($request->query->get('destinationName')) {
            $offers = $this->getOffersBasedOnDestination($offerService, $request->query->get('destinationName'));
            $queryDestination = $this->destinationRepository->findOneBy(['destinationName' => $request->query->get('destinationName')]);
            $bookingOffer->setDestination($queryDestination);
        } else {
            $offers = $offerService->findOffers();
        }
        $allOffers = $this->bookingOfferRepository->findAll();
        foreach ($allOffers as $offer) {
            $departureSpots[$offer->getDepartureSpot()] = $offer->getDepartureSpot();
        }
        $filtersForm = $this->createForm(BookingOfferFiltersType::class, $bookingOffer, [
            'method' => 'GET',
            'departureSpots' => $departureSpots,
        ]);
        if ($request->query->get('offerType')) {
            $fetchedType = $this->bookingOfferTypeRepository->findOneBy(['typeName' => $request->query->get('offerType')]);
            if ($fetchedType) {
                $typeId = $fetchedType->getId();
                $filtersForm->get('offerTypes')->get("{$typeId}")->setData(true);
            }
        }
        $filtersForm->handleRequest($request);
        if ($filtersForm->isSubmitted() && $filtersForm->isValid()) {
            $offers = $this->getOffersBasedOnFormSubmission($offerService, $filtersForm, $bookingOffer);
        }

        return $this->render('offer/browser.html.twig', [
            'offers' => $offers,
            'parameters' => $request->attributes->all(),
            'offer_filters_form' => $filtersForm->createView(),
        ]);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/reservationSummary/{offerId}/adults/{adultNumber}/children/{childNumber}', name: 'reservationSummary')]
    public function displayReservationSummary(
        Request $request,
        #[CurrentUser] User $user,
        int $offerId,
        int $adultNumber,
        int $childNumber,
    ): Response {
        $offer = $this->bookingOfferRepository->find($offerId);

        $reservation = new Reservation();
        $reservation->setBookingOffer($offer);
        $reservation->setAdultNumber($adultNumber);
        $reservation->setChildNumber($childNumber);
        $reservation->setBankTransferTitle();
        $reservation->setTotalCost($this->getReservationTotalCost($reservation));
        $reservation->setUser($user);

        $form = $this->createForm(ConfirmReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setDateOfBooking(new \DateTime('NOW'));
            $reservation->setIsPaidFor(false);
            $this->entityManager->persist($reservation);
            $this->entityManager->flush();

            return $this->redirectToRoute('reservations');
        }

        return $this->render('offer/reservation_summary.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/{id}', name: 'single')]
    public function displayOffer(Request $request, int $id): Response
    {
        $offer = $this->bookingOfferRepository->findOffer($id);

        $finder = new Finder();
        $finder->files()->in($offer->getPhotosDirectory());

        $photosCount = 0;
        if ($finder->hasResults()) {
            $photosCount = $finder->count();
        }

        $reservation = new Reservation();
        $reservation->setBookingOffer($offer);
        $reservationForm = $this->createForm(ReservationStartType::class, $reservation);
        $reservationForm->handleRequest($request);
        if ($reservationForm->isSubmitted() && $reservationForm->isValid()) {
            return $this->redirectToRoute('offer_reservationSummary', [
                'offerId' => $id,
                'adultNumber' => $reservation->getAdultNumber(),
                'childNumber' => $reservation->getChildNumber(),
            ]);
        }

        return $this->render('offer/single_offer.html.twig', [
            'offer' => $offer,
            'init_reservation_form' => $reservationForm->createView(),
            'photosCount' => $photosCount,
        ]);
    }

    private function getWellFormattedDate(string $date)
    {
        $reformatted = explode('/', $date);
        $reformatted = $reformatted[2].'/'.$reformatted[1].'/'.$reformatted[0];

        return new \DateTime($reformatted);
    }

    private function getOffersBasedOnFormSubmission(BookingOfferService $offerService, FormInterface $filtersForm, BookingOffer $bookingOffer)
    {
        $priceMin = $filtersForm->get('priceMin')->getData();
        $priceMax = $filtersForm->get('priceMax')->getData();
        $offerTypes = $filtersForm->get('offerTypes')->getData();

        return $offerService->findOffers(
            $bookingOffer->getDepartureSpot(),
            $bookingOffer->getDestination(),
            $bookingOffer->getDepartureDate(),
            $bookingOffer->getComebackDate(),
            $priceMin,
            $priceMax,
            $offerTypes
        );
    }

    private function getOffersBasedOnRequestQuery(BookingOfferService $offerService, Request $request, BookingOffer $bookingOffer)
    {
        $requestParams = $request->query->get('booking_offer_search');
        $departureSpot = $requestParams['departureSpot'] ?? null;
        $destination = $requestParams['destination'] ?? null;
        $departureDate = $requestParams['departureDate'] ?? null;
        $comebackDate = $requestParams['comebackDate'] ?? null;
        if (null != $departureDate) {
            $bookingOffer->setDepartureDate($this->getWellFormattedDate($departureDate));
        }
        if (null != $comebackDate) {
            $bookingOffer->setComebackDate($this->getWellFormattedDate($comebackDate));
        }
        $bookingOffer->setDepartureSpot($departureSpot);
        $bookingOffer->setDestination($this->destinationRepository->find($destination));

        return $offerService->findOffers($departureSpot,
            $destination,
            $bookingOffer->getDepartureDate(),
            $bookingOffer->getComebackDate());
    }

    private function getOffersBasedOnOfferType(BookingOfferService $offerService, string $offerTypeName)
    {
        $offerType = $this->bookingOfferTypeRepository->findOneBy(['typeName' => $offerTypeName]);

        if (null != $offerType) {
            $offers = $offerService->findOffers(null, null, null, null, null, null, [$offerType]);
        } else {
            $offers = null;
        }

        return $offers;
    }

    private function getOffersBasedOnDestination(BookingOfferService $offerService, string $destinationName)
    {
        $destination = $this->destinationRepository->findOneBy(['destinationName' => $destinationName]);

        if (null != $destination) {
            $offers = $offerService->findOffers(null, $destination, null, null, null, null, null);
        } else {
            $offers = null;
        }

        return $offers;
    }

    private function getReservationTotalCost($reservation)
    {
        $adultPrice = $reservation->getBookingOffer()->getOfferPrice();
        $childPrice = $reservation->getBookingOffer()->getChildPrice();

        return $reservation->getAdultNumber() * $adultPrice + $reservation->getChildNumber() * $childPrice;
    }
}
