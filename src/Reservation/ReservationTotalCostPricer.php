<?php

declare(strict_types=1);

namespace App\Reservation;

use App\Entity\BookingOffer;

final class ReservationTotalCostPricer implements ReservationPricer
{
    #[\Override]
    public function price(BookingOffer $bookingOffer, int $numberOfAdults = 2, int $numberOfChildren = 0, array $options = []): float
    {
        $adultPrice = $bookingOffer->getOfferPrice();

        if (null === $adultPrice) {
            throw new \DomainException('Booking offer does not hold a price for a single adult.');
        }

        $childPrice = $bookingOffer->getChildPrice();

        if (null === $childPrice) {
            throw new \DomainException('Booking offer does not hold a price for a single child.');
        }

        return $numberOfAdults * $adultPrice + $numberOfChildren * $childPrice;
    }
}
