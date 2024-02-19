<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\BookingOffer;
use App\Entity\Reservation;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

final class ReservationTest extends TestCase
{
    public function testCreateNewValidReservation(): void
    {
        $user = new User();
        $offer = new BookingOffer();

        $reservation = new Reservation($user, $offer, 3, 2);

        $this->assertSame($user, $reservation->getUser());
        $this->assertSame($offer, $reservation->getBookingOffer());
        $this->assertSame(3, $reservation->getAdultNumber());
        $this->assertSame(2, $reservation->getChildNumber());
    }

    public function testReservationDoesNotAcceptMoreThan10Adults(): void
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Reservation cannot be taken for more than 10 adults.');

        new Reservation(new User(), new BookingOffer(), 1, 2);
    }
}
