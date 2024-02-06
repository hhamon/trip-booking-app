<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\BookingOffer;
use App\Entity\BookingOfferType;
use App\Entity\Destination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class BookingOfferFixture extends Fixture implements DependentFixtureInterface
{
    public const string SUMMER_CHILL_REFERENCE = 'H- Summer n\' Chill';
    public const string FAMOUS_TURK_REFERENCE = 'H- Le famous Turk';
    public const string MAHARAJA_REFERENCE1 = 'H- Maharaja\'s Rest1';
    public const string MAHARAJA_REFERENCE2 = 'H- Maharaja\'s Rest2';
    public const string AKASAKA_REFERENCE = 'R- Akasaka Onsen Resort';
    public const string SYDNEY_REFERENCE = 'Y- Sydney\'s prime';
    public const string MAFIOSO_REFERENCE1 = 'H- Il Mafioso1';
    public const string MAFIOSO_REFERENCE2 = 'H- Il Mafioso2';
    public const string BUDDHA_REFERENCE = 'H- Buddha\'s way';
    public const string BEIJING_REFERENCE = 'H- Bei-JING';
    public const string PATAGONIA_REFERENCE = 'H- Patagonia';

    #[\Override]
    public function load(ObjectManager $manager): void
    {
        $bookingOffer = $this->createBookingOffer(
            $this->getDestination(DestinationFixture::SPAIN_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque autem cum delectus doloribus 
                      error eum facilis in itaque laudantium natus nesciunt odit, officia quasi ratione recusandae rem, rerum unde.
                      Beatae cumque debitis iure nihil officiis perferendis soluta unde! Alias animi iure maxime repudiandae. 
                      Assumenda atque blanditiis dolorum esse, expedita, ipsum iste laboriosam libero magnam, magni odit quae quos sed?',
            $this->getBookingOfferType(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Summer n\' Chill',
            1520.00,
            620.00,
            2,
            new \DateTime('-6 months'),
            new \DateTime('+6 months'),
            new \DateTime('+8 months'),
            new \DateTime('+12 months'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );

        $this->addReference(self::SUMMER_CHILL_REFERENCE, $bookingOffer);

        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getDestination(DestinationFixture::TURKEY_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque autem cum delectus doloribus 
                      error eum facilis in itaque laudantium natus nesciunt odit, officia quasi ratione recusandae rem, rerum unde.
                      Beatae cumque debitis iure nihil officiis perferendis soluta unde! Alias animi iure maxime repudiandae. 
                      Assumenda atque blanditiis dolorum esse, expedita, ipsum iste laboriosam libero magnam, magni odit quae quos sed?',
            $this->getBookingOfferType(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Le famous Turk',
            1200.00,
            500.00,
            3,
            new \DateTime('-6 months'),
            new \DateTime('+6 months'),
            new \DateTime('+8 months'),
            new \DateTime('+12 months'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );

        $this->addReference(self::FAMOUS_TURK_REFERENCE, $bookingOffer);

        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getDestination(DestinationFixture::INDIA_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getBookingOfferType(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Maharaja\'s Rest',
            2100.00,
            1800.00,
            4,
            new \DateTime('-6 months'),
            new \DateTime('+6 months'),
            new \DateTime('+8 months'),
            new \DateTime('+12 months'),
            'Balice Airport',
            'Balice Airport',
            false
        );
        $this->addReference(self::MAHARAJA_REFERENCE1, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getDestination(DestinationFixture::INDIA_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getBookingOfferType(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Maharaja\'s Rest',
            2100.00,
            1800.00,
            4,
            new \DateTime('-6 months'),
            new \DateTime('+6 months'),
            new \DateTime('+8 months'),
            new \DateTime('+12 months'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $this->addReference(self::MAHARAJA_REFERENCE2, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getDestination(DestinationFixture::JAPAN_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getBookingOfferType(BookingOfferTypeFixtures::ALL_INCLUSIVE_REFERENCE),
            'R- Akasaka Onsen Resort',
            3550.00,
            3350.00,
            5,
            new \DateTime('-6 months'),
            new \DateTime('-1 months'),
            new \DateTime('-2 months'),
            new \DateTime('-1 months'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            true
        );
        $this->addReference(self::AKASAKA_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getDestination(DestinationFixture::AUSTRALIA_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque autem cum delectus doloribus 
                      error eum facilis in itaque laudantium natus nesciunt odit, officia quasi ratione recusandae rem, rerum unde.
                      Beatae cumque debitis iure nihil officiis perferendis soluta unde! Alias animi iure maxime repudiandae. 
                      Assumenda atque blanditiis dolorum esse, expedita, ipsum iste laboriosam libero magnam, magni odit quae quos sed?',
            $this->getBookingOfferType(BookingOfferTypeFixtures::CRUISES_REFERENCE),
            'Y- Sydney\'s prime',
            2700.00,
            1900.00,
            6,
            new \DateTime('-6 months'),
            new \DateTime('+6 months'),
            new \DateTime('+8 months'),
            new \DateTime('+12 months'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $this->addReference(self::SYDNEY_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getDestination(DestinationFixture::ITALY_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getBookingOfferType(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Il Mafioso',
            1200.00,
            980.00,
            7,
            new \DateTime('-6 months'),
            new \DateTime('+6 months'),
            new \DateTime('+8 months'),
            new \DateTime('+12 months'),
            'Modlin Airport',
            'Modlin Airport',
            false
        );
        $this->addReference(self::MAFIOSO_REFERENCE1, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getDestination(DestinationFixture::ITALY_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getBookingOfferType(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Il Mafioso',
            1200.00,
            980.00,
            7,
            new \DateTime('-6 months'),
            new \DateTime('+6 months'),
            new \DateTime('+8 months'),
            new \DateTime('+12 months'),
            'Modlin Airport',
            'Modlin Airport',
            false
        );
        $this->addReference(self::MAFIOSO_REFERENCE2, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getDestination(DestinationFixture::THAILAND_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque autem cum delectus doloribus 
                      error eum facilis in itaque laudantium natus nesciunt odit, officia quasi ratione recusandae rem, rerum unde.
                      Beatae cumque debitis iure nihil officiis perferendis soluta unde! Alias animi iure maxime repudiandae. 
                      Assumenda atque blanditiis dolorum esse, expedita, ipsum iste laboriosam libero magnam, magni odit quae quos sed?',
            $this->getBookingOfferType(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Buddha\'s way',
            1580.00,
            940.00,
            8,
            new \DateTime('-6 months'),
            new \DateTime('+6 months'),
            new \DateTime('+8 months'),
            new \DateTime('+12 months'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $this->addReference(self::BUDDHA_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getDestination(DestinationFixture::CHINA_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque autem cum delectus doloribus 
                      error eum facilis in itaque laudantium natus nesciunt odit, officia quasi ratione recusandae rem, rerum unde.
                      Beatae cumque debitis iure nihil officiis perferendis soluta unde! Alias animi iure maxime repudiandae. 
                      Assumenda atque blanditiis dolorum esse, expedita, ipsum iste laboriosam libero magnam, magni odit quae quos sed?',
            $this->getBookingOfferType(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Bei-JING',
            1520.00,
            800.00,
            9,
            new \DateTime('-6 months'),
            new \DateTime('+6 months'),
            new \DateTime('+8 months'),
            new \DateTime('+12 months'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            true
        );
        $this->addReference(self::BEIJING_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getDestination(DestinationFixture::ARGENTINA_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getBookingOfferType(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Patagonia',
            2800.00,
            2400.00,
            10,
            new \DateTime('-6 months'),
            new \DateTime('+6 months'),
            new \DateTime('+8 months'),
            new \DateTime('+12 months'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            true
        );
        $this->addReference(self::PATAGONIA_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $manager->flush();
    }

    private function createBookingOffer(
        Destination $destination,
        string $description,
        BookingOfferType $offerType,
        string $offerName,
        float $offerPrice,
        float $childPrice,
        int $packageId,
        \DateTime $bookingStartDate,
        \DateTime $bookingEndDate,
        \DateTime $departureDate,
        \DateTime $comebackDate,
        string $departureSpot,
        string $comebackSpot,
        bool $isFeatured,
    ): BookingOffer {
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
        $bookingOffer->setPhotosDirectory('images/offers_cards/'.$packageId);

        return $bookingOffer;
    }

    /**
     * @return class-string[]
     */
    #[\Override]
    public function getDependencies(): array
    {
        return [DestinationFixture::class, BookingOfferTypeFixtures::class];
    }

    private function getDestination(string $referenceKey): Destination
    {
        $destination = $this->getReference($referenceKey);
        \assert($destination instanceof Destination);

        return $destination;
    }

    private function getBookingOfferType(string $referenceKey): BookingOfferType
    {
        $bookingOfferType = $this->getReference($referenceKey);
        \assert($bookingOfferType instanceof BookingOfferType);

        return $bookingOfferType;
    }
}
