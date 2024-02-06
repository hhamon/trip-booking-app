<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Continent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class ContinentFixture extends Fixture
{
    public const string AFRICA_REFERENCE = 'africa';
    public const string ANTARCTICA_REFERENCE = 'antarctica';
    public const string ASIA_REFERENCE = 'asia';
    public const string OCEANIA_REFERENCE = 'oceania';
    public const string EUROPE_REFERENCE = 'europe';
    public const string NORTH_AMERICA_REFERENCE = 'north america';
    public const string SOUTH_AMERICA_REFERENCE = 'south america';

    /**
     * @var array<string, string>
     */
    private const array NAME_MAP = [
        self::AFRICA_REFERENCE => 'Africa',
        self::ANTARCTICA_REFERENCE => 'Antarctica',
        self::ASIA_REFERENCE => 'Asia',
        self::OCEANIA_REFERENCE => 'Australia',
        self::EUROPE_REFERENCE => 'Europe',
        self::NORTH_AMERICA_REFERENCE => 'North America',
        self::SOUTH_AMERICA_REFERENCE => 'South America',
    ];

    #[\Override]
    public function load(ObjectManager $manager): void
    {
        foreach (self::NAME_MAP as $referenceKey => $name) {
            $continent = new Continent($name);
            $manager->persist($continent);

            $this->addReference($referenceKey, $continent);
        }

        $manager->flush();
    }
}
