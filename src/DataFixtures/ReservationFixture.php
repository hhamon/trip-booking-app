<?php

namespace App\DataFixtures;

use App\Entity\Reservation;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReservationFixture extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $reservation = $this->createReservation(
            $this->getReference(UserFixture::USER1_REFERENCE),
            $this->getReference(BookingOfferFixture::BEIJING_REFERENCE),
            1,
            0,
            new DateTime('2020-11-22')
        );
        $manager->persist($reservation);

        $reservation = $this->createPaidReservation(
            $this->getReference(UserFixture::USER1_REFERENCE),
            $this->getReference(BookingOfferFixture::PATAGONIA_REFERENCE),
            2,
            2,
            new DateTime('2020-11-22'),
            new DateTime('2020-11-24')
        );
        $manager->persist($reservation);

        $reservation = $this->createPaidReservation(
            $this->getReference(UserFixture::USER2_REFERENCE),
            $this->getReference(BookingOfferFixture::MAFIOSO_REFERENCE1),
            1,
            2,
            new DateTime('2019-06-22'),
            new DateTime('2019-06-24')
        );
        $manager->persist($reservation);

        $reservation = $this->createReservation(
            $this->getReference(UserFixture::USER2_REFERENCE),
            $this->getReference(BookingOfferFixture::PATAGONIA_REFERENCE),
            5,
            0,
            new DateTime('2020-11-23')
        );
        $manager->persist($reservation);

        $reservation = $this->createPaidReservation(
            $this->getReference(UserFixture::USER2_REFERENCE),
            $this->getReference(BookingOfferFixture::BEIJING_REFERENCE),
            3,
            2,
            new DateTime('2020-11-22'),
            new DateTime('2020-11-22')
        );
        $manager->persist($reservation);

        $reservation = $this->createPaidReservation(
            $this->getReference(UserFixture::USER2_REFERENCE),
            $this->getReference(BookingOfferFixture::MAHARAJA_REFERENCE1),
            2,
            0,
            new DateTime('2020-04-22'),
            new DateTime('2020-04-24')
        );
        $manager->persist($reservation);

        $manager->flush();
    }

    private function createReservation($user, $bookingOffer, $adultNumber, $childNumber, $dateOfBooking, $paid = false): Reservation
    {
        $reservation = new Reservation();
        $reservation->setUser($user);
        $reservation->setBookingOffer($bookingOffer);
        $reservation->setAdultNumber($adultNumber);
        $reservation->setChildNumber($childNumber);
        $reservation->setDateOfBooking($dateOfBooking);
        $reservation->setIsPaidFor($paid);
        $reservation->setBankTransferTitle();
        return $reservation;
    }

    private function createPaidReservation($user, $bookingOffer, $adultNumber, $childNumber, $dateOfBooking, $bankTransferDate): Reservation
    {
        $reservation = $this->createReservation($user, $bookingOffer, $adultNumber, $childNumber, $dateOfBooking, true);
        $reservation->setBankTransferDate($bankTransferDate);
        return $reservation;
    }

    public function getDependencies()
    {
        return [UserFixture::class, BookingOfferFixture::class];
    }
}