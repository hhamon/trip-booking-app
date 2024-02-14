<?php

declare(strict_types=1);

namespace App\Reservation;

use App\Entity\BookingOffer;
use App\Entity\Reservation;
use App\Entity\User;

interface ReservationFactory
{
    /**
     * @param array<string, mixed> $options
     */
    public function create(
        User $customer,
        BookingOffer $bookingOffer,
        int $numberOfAdults,
        int $numberOfChildren,
        array $options = [],
    ): Reservation;
}
