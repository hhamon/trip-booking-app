<?php

declare(strict_types=1);

namespace App\Reservation;

use App\Entity\BookingOffer;

interface ReservationPricer
{
    /**
     * @param array<string, mixed> $options
     */
    public function price(
        BookingOffer $bookingOffer,
        int $numberOfAdults = 2,
        int $numberOfChildren = 0,
        array $options = [],
    ): float;
}
