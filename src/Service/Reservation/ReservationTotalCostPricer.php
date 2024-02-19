<?php

declare(strict_types=1);

namespace App\Service\Reservation;

use App\Entity\BookingOffer;

class ReservationTotalCostPricer
{
    public function getTotalCost(BookingOffer $offer, int $adultNumber, int $childNumber): float
    {
        $unitPrice = $offer->getOfferPrice();

        if ($unitPrice === null) {
            throw new \RuntimeException('Offer is not priced yet.');
        }

        return $unitPrice * $adultNumber + $unitPrice * $childNumber;
    }
}
