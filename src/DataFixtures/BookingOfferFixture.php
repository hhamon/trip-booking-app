<?php

namespace App\DataFixtures;

use App\Entity\BookingOffer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookingOfferFixture extends Fixture implements DependentFixtureInterface
{
    public const SUMMER_CHILL_REFERENCE = 'H- Summer n\' Chill';
    public const FAMOUS_TURK_REFERENCE = 'H- Le famous Turk';
    public const MAHARAJA_REFERENCE1 = 'H- Maharaja\'s Rest1';
    public const MAHARAJA_REFERENCE2 = 'H- Maharaja\'s Rest2';
    public const AKASAKA_REFERENCE = 'R- Akasaka Onsen Resort';
    public const SYDNEY_REFERENCE = 'Y- Sydney\'s prime';
    public const MAFIOSO_REFERENCE1 = 'H- Il Mafioso1';
    public const MAFIOSO_REFERENCE2 = 'H- Il Mafioso2';
    public const BUDDHA_REFERENCE = 'H- Buddha\'s way';
    public const BEIJING_REFERENCE = 'H- Bei-JING';
    public const PATAGONIA_REFERENCE = 'H- Patagonia';

    public function load(ObjectManager $manager)
    {
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::SPAIN_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque autem cum delectus doloribus 
                      error eum facilis in itaque laudantium natus nesciunt odit, officia quasi ratione recusandae rem, rerum unde.
                      Beatae cumque debitis iure nihil officiis perferendis soluta unde! Alias animi iure maxime repudiandae. 
                      Assumenda atque blanditiis dolorum esse, expedita, ipsum iste laboriosam libero magnam, magni odit quae quos sed?',
            $this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Summer n\' Chill',
            1520.00,
            620.00,
            2,
            new \DateTime('2022-11-23'),
            new \DateTime('2023-03-05'),
            new \DateTime('2023-03-06'),
            new \DateTime('2023-03-20'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $this->addReference(self::SUMMER_CHILL_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::TURKEY_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque autem cum delectus doloribus 
                      error eum facilis in itaque laudantium natus nesciunt odit, officia quasi ratione recusandae rem, rerum unde.
                      Beatae cumque debitis iure nihil officiis perferendis soluta unde! Alias animi iure maxime repudiandae. 
                      Assumenda atque blanditiis dolorum esse, expedita, ipsum iste laboriosam libero magnam, magni odit quae quos sed?',
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Le famous Turk',
            1200.00,
            500.00,
            3,
            new \DateTime('2022-07-05'),
            new \DateTime('2023-02-05'),
            new \DateTime('2023-02-06'),
            new \DateTime('2023-02-20'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $this->addReference(self::FAMOUS_TURK_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::INDIA_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Maharaja\'s Rest',
            2100.00,
            1800.00,
            4,
            new \DateTime('2022-04-15'),
            new \DateTime('2023-05-15'),
            new \DateTime('2023-11-16'),
            new \DateTime('2023-11-30'),
            'Balice Airport',
            'Balice Airport',
            false
        );
        $this->addReference(self::MAHARAJA_REFERENCE1, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::INDIA_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Maharaja\'s Rest',
            2100.00,
            1800.00,
            4,
            new \DateTime('2022-08-15'),
            new \DateTime('2023-01-15'),
            new \DateTime('2023-01-16'),
            new \DateTime('2023-01-30'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $this->addReference(self::MAHARAJA_REFERENCE2, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::JAPAN_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getReference(BookingOfferTypeFixtures::ALL_INCLUSIVE_REFERENCE),
            'R- Akasaka Onsen Resort',
            3550.00,
            3350.00,
            5,
            new \DateTime('2022-05-05'),
            new \DateTime('2023-12-06'),
            new \DateTime('2023-12-07'),
            new \DateTime('2023-12-14'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            true
        );
        $this->addReference(self::AKASAKA_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::AUSTRALIA_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque autem cum delectus doloribus 
                      error eum facilis in itaque laudantium natus nesciunt odit, officia quasi ratione recusandae rem, rerum unde.
                      Beatae cumque debitis iure nihil officiis perferendis soluta unde! Alias animi iure maxime repudiandae. 
                      Assumenda atque blanditiis dolorum esse, expedita, ipsum iste laboriosam libero magnam, magni odit quae quos sed?',
            $this->getReference(BookingOfferTypeFixtures::CRUISES_REFERENCE),
            'Y- Sydney\'s prime',
            2700.00,
            1900.00,
            6,
            new \DateTime('2022-04-10'),
            new \DateTime('2023-12-10'),
            new \DateTime('2023-12-11'),
            new \DateTime('2023-12-18'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $this->addReference(self::SYDNEY_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::ITALY_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Il Mafioso',
            1200.00,
            980.00,
            7,
            new \DateTime('2022-05-05'),
            new \DateTime('2023-12-05'),
            new \DateTime('2023-12-06'),
            new \DateTime('2023-12-20'),
            'Modlin Airport',
            'Modlin Airport',
            false
        );
        $this->addReference(self::MAFIOSO_REFERENCE1, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::ITALY_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Il Mafioso',
            1200.00,
            980.00,
            7,
            new \DateTime('2023-05-05'),
            new \DateTime('2023-12-05'),
            new \DateTime('2023-12-06'),
            new \DateTime('2023-12-20'),
            'Modlin Airport',
            'Modlin Airport',
            false
        );
        $this->addReference(self::MAFIOSO_REFERENCE2, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::THAILAND_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque autem cum delectus doloribus 
                      error eum facilis in itaque laudantium natus nesciunt odit, officia quasi ratione recusandae rem, rerum unde.
                      Beatae cumque debitis iure nihil officiis perferendis soluta unde! Alias animi iure maxime repudiandae. 
                      Assumenda atque blanditiis dolorum esse, expedita, ipsum iste laboriosam libero magnam, magni odit quae quos sed?',
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Buddha\'s way',
            1580.00,
            940.00,
            8,
            new \DateTime('2022-09-05'),
            new \DateTime('2023-02-05'),
            new \DateTime('2023-02-06'),
            new \DateTime('2023-02-20'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $this->addReference(self::BUDDHA_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::CHINA_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque autem cum delectus doloribus 
                      error eum facilis in itaque laudantium natus nesciunt odit, officia quasi ratione recusandae rem, rerum unde.
                      Beatae cumque debitis iure nihil officiis perferendis soluta unde! Alias animi iure maxime repudiandae. 
                      Assumenda atque blanditiis dolorum esse, expedita, ipsum iste laboriosam libero magnam, magni odit quae quos sed?',
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Bei-JING',
            1520.00,
            800.00,
            9,
            new \DateTime('2022-11-10'),
            new \DateTime('2023-01-05'),
            new \DateTime('2023-06-06'),
            new \DateTime('2023-06-20'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            true
        );
        $this->addReference(self::BEIJING_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::ARGENTINA_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Patagonia',
            2800.00,
            2400.00,
            10,
            new \DateTime('2022-11-22'),
            new \DateTime('2023-04-05'),
            new \DateTime('2023-05-06'),
            new \DateTime('2023-05-25'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            true
        );
        $this->addReference(self::PATAGONIA_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $manager->flush();
    }

    private function createBookingOffer($destination, $description, $offerType, $offerName, $offerPrice, $childPrice, $packageId, $bookingStartDate, $bookingEndDate, $departureDate, $comebackDate, $departureSpot, $comebackSpot, $isFeatured): BookingOffer
    {
        $bookingOffer = new BookingOffer();
        $bookingOffer->setDestination($destination);
        $bookingOffer->setDescription($description);
        $bookingOffer->setOfferType($offerType);
        $bookingOffer->setOfferName($offerName);
        $bookingOffer->setOfferPrice($offerPrice);
        $bookingOffer->setChildPrice($childPrice);
        $bookingOffer->setPackageId($packageId);
        $bookingOffer->setBookingStartDate($bookingStartDate);
        $bookingOffer->setBookingEndDate($bookingEndDate);
        $bookingOffer->setDepartureDate($departureDate);
        $bookingOffer->setComebackDate($comebackDate);
        $bookingOffer->setDepartureSpot($departureSpot);
        $bookingOffer->setComebackSpot($comebackSpot);
        $bookingOffer->setIsFeatured($isFeatured);
        $bookingOffer->setPhotosDirectory('images/offers_cards/' . $packageId);

        return $bookingOffer;
    }

    public function getDependencies()
    {
        return [DestinationFixture::class, BookingOfferTypeFixtures::class];
    }
}
