<?php

declare(strict_types=1);

namespace App\Reservation;

use App\Entity\BookingOffer;
use App\Entity\Reservation;
use App\Entity\User;

final readonly class ReservationQuoteFactory implements ReservationFactory
{
    public function __construct(
        private ReservationPricer $reservationTotalCostPricer,
    ) {
    }

    /**
     * @param array<string, mixed> $options
     */
    #[\Override]
    public function create(User $customer, BookingOffer $bookingOffer, int $numberOfAdults, int $numberOfChildren, array $options = []): Reservation
    {
        $totalCost = $this->reservationTotalCostPricer->price($bookingOffer, $numberOfAdults, $numberOfChildren);

        $reservation = new Reservation();
        $reservation->setUser($customer);
        $reservation->setBookingOffer($bookingOffer);
        $reservation->setAdultNumber($numberOfAdults);
        $reservation->setChildNumber($numberOfChildren);
        $reservation->setTotalCost($totalCost);
        $reservation->setBankTransferTitle();

        return $reservation;
    }
}
