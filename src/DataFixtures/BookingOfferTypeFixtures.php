<?php

namespace App\DataFixtures;

use App\Entity\BookingOfferType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookingOfferTypeFixtures extends Fixture
{
    public const FIRST_MINUTE_REFERENCE = 'first_minute';
    public const LAST_MINUTE_REFERENCE = 'last_minute';
    public const ALL_INCLUSIVE_REFERENCE = 'all_inclusive';
    public const FOR_CHILDREN_REFERENCE = 'for_children';
    public const GROUP_TOURS_REFERENCE = 'group_tours';
    public const CRUISES_REFERENCE = 'cruises';

    public function load(ObjectManager $manager): void
    {
        $offerType = new BookingOfferType();
        $offerType->setTypeName('First Minute');
        $this->addReference(self::FIRST_MINUTE_REFERENCE, $offerType);
        $manager->persist($offerType);

        $offerType = new BookingOfferType();
        $offerType->setTypeName('Last Minute');
        $this->addReference(self::LAST_MINUTE_REFERENCE, $offerType);
        $manager->persist($offerType);

        $offerType = new BookingOfferType();
        $offerType->setTypeName('All Inclusive');
        $this->addReference(self::ALL_INCLUSIVE_REFERENCE, $offerType);
        $manager->persist($offerType);

        $offerType = new BookingOfferType();
        $offerType->setTypeName('For Children');
        $this->addReference(self::FOR_CHILDREN_REFERENCE, $offerType);
        $manager->persist($offerType);

        $offerType = new BookingOfferType();
        $offerType->setTypeName('Group Tours');
        $this->addReference(self::GROUP_TOURS_REFERENCE, $offerType);
        $manager->persist($offerType);

        $offerType = new BookingOfferType();
        $offerType->setTypeName('Cruises');
        $this->addReference(self::CRUISES_REFERENCE, $offerType);
        $manager->persist($offerType);

        $manager->flush();
    }
}
