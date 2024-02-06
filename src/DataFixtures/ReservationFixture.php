<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\BookingOffer;
use App\Entity\Reservation;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ReservationFixture extends Fixture implements DependentFixtureInterface
{
    #[\Override]
    public function load(ObjectManager $manager): void
    {
        $manager->persist($this->createReservation(
            UserFixture::USER1_REFERENCE,
            BookingOfferFixture::BEIJING_REFERENCE,
            1,
            0,
            new \DateTime('2020-11-22'),
        ));

        $manager->persist($this->createPaidReservation(
            UserFixture::USER1_REFERENCE,
            BookingOfferFixture::PATAGONIA_REFERENCE,
            2,
            2,
            new \DateTime('2020-11-22'),
            new \DateTime('2020-11-24'),
        ));

        $manager->persist($this->createPaidReservation(
            UserFixture::USER2_REFERENCE,
            BookingOfferFixture::MAFIOSO_REFERENCE1,
            1,
            2,
            new \DateTime('2019-06-22'),
            new \DateTime('2019-06-24'),
        ));

        $manager->persist($this->createReservation(
            UserFixture::USER2_REFERENCE,
            BookingOfferFixture::PATAGONIA_REFERENCE,
            5,
            0,
            new \DateTime('2020-11-23'),
        ));

        $manager->persist($this->createPaidReservation(
            UserFixture::USER2_REFERENCE,
            BookingOfferFixture::BEIJING_REFERENCE,
            3,
            2,
            new \DateTime('2020-11-22'),
            new \DateTime('2020-11-22'),
        ));

        $manager->persist($this->createPaidReservation(
            UserFixture::USER2_REFERENCE,
            BookingOfferFixture::MAHARAJA_REFERENCE1,
            2,
            0,
            new \DateTime('2020-04-22'),
            new \DateTime('2020-04-24'),
        ));

        $manager->flush();
    }

    private function createReservation(
        string $user,
        string $bookingOffer,
        int $adultNumber,
        int $childNumber,
        \DateTime $dateOfBooking,
        bool $paid = false,
    ): Reservation {
        $reservation = new Reservation();
        $reservation->setUser($this->getUser($user));
        $reservation->setBookingOffer($this->getBookingOffer($bookingOffer));
        $reservation->setAdultNumber($adultNumber);
        $reservation->setChildNumber($childNumber);
        $reservation->setDateOfBooking($dateOfBooking);
        $reservation->setIsPaidFor($paid);
        $reservation->setBankTransferTitle();

        return $reservation;
    }

    private function createPaidReservation(
        string $user,
        string $bookingOffer,
        int $adultNumber,
        int $childNumber,
        \DateTime $dateOfBooking,
        \DateTime $bankTransferDate,
    ): Reservation {
        $reservation = $this->createReservation($user, $bookingOffer, $adultNumber, $childNumber, $dateOfBooking, paid: true);
        $reservation->setBankTransferDate($bankTransferDate);

        return $reservation;
    }

    /**
     * @return class-string[]
     */
    #[\Override]
    public function getDependencies(): array
    {
        return [UserFixture::class, BookingOfferFixture::class];
    }

    private function getUser(string $referenceKey): User
    {
        $user = $this->getReference($referenceKey);
        \assert($user instanceof User);

        return $user;
    }

    private function getBookingOffer(string $referenceKey): BookingOffer
    {
        $bookingOffer = $this->getReference($referenceKey);
        \assert($bookingOffer instanceof BookingOffer);

        return $bookingOffer;
    }
}
