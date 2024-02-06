<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\BookingOfferType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class BookingOfferTypeFixtures extends Fixture
{
    public const string FIRST_MINUTE_REFERENCE = 'first_minute';
    public const string LAST_MINUTE_REFERENCE = 'last_minute';
    public const string ALL_INCLUSIVE_REFERENCE = 'all_inclusive';
    public const string FOR_CHILDREN_REFERENCE = 'for_children';
    public const string GROUP_TOURS_REFERENCE = 'group_tours';
    public const string CRUISES_REFERENCE = 'cruises';

    /**
     * @var array<string, string>
     */
    private const array NAME_MAP = [
        self::FIRST_MINUTE_REFERENCE => 'First Minute',
        self::LAST_MINUTE_REFERENCE => 'Last Minute',
        self::ALL_INCLUSIVE_REFERENCE => 'All Inclusive',
        self::FOR_CHILDREN_REFERENCE => 'For Children',
        self::GROUP_TOURS_REFERENCE => 'Group Tours',
        self::CRUISES_REFERENCE => 'Cruises',
    ];

    #[\Override]
    public function load(ObjectManager $manager): void
    {
        foreach (self::NAME_MAP as $referenceKey => $name) {
            $offerType = new BookingOfferType($name);
            $manager->persist($offerType);

            $this->addReference($referenceKey, $offerType);
        }

        $manager->flush();
    }
}
