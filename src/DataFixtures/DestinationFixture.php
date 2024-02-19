<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Continent;
use App\Entity\Destination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class DestinationFixture extends Fixture implements DependentFixtureInterface
{
    public const string SPAIN_REFERENCE = 'spain';

    public const string TURKEY_REFERENCE = 'turkey';

    public const string INDIA_REFERENCE = 'india';

    public const string JAPAN_REFERENCE = 'japan';

    public const string AUSTRALIA_REFERENCE = 'australia';

    public const string NEW_ZEALAND_REFERENCE = 'new_zealand';

    public const string ITALY_REFERENCE = 'italy';

    public const string THAILAND_REFERENCE = 'thailand';

    public const string CHINA_REFERENCE = 'china';

    public const string ARGENTINA_REFERENCE = 'argentina';

    /**
     * @var array<string, array{name: string, continent: string}>
     */
    private const array NAME_MAP = [
        self::ITALY_REFERENCE => [
            'name' => 'Italy',
            'continent' => ContinentFixture::EUROPE_REFERENCE,
        ],
        self::SPAIN_REFERENCE => [
            'name' => 'Spain',
            'continent' => ContinentFixture::EUROPE_REFERENCE,
        ],
        self::CHINA_REFERENCE => [
            'name' => 'China',
            'continent' => ContinentFixture::ASIA_REFERENCE,
        ],
        self::INDIA_REFERENCE => [
            'name' => 'India',
            'continent' => ContinentFixture::ASIA_REFERENCE,
        ],
        self::JAPAN_REFERENCE => [
            'name' => 'Japan',
            'continent' => ContinentFixture::ASIA_REFERENCE,
        ],
        self::THAILAND_REFERENCE => [
            'name' => 'Thailand',
            'continent' => ContinentFixture::ASIA_REFERENCE,
        ],
        self::TURKEY_REFERENCE => [
            'name' => 'Turkey',
            'continent' => ContinentFixture::ASIA_REFERENCE,
        ],
        self::AUSTRALIA_REFERENCE => [
            'name' => 'Australia',
            'continent' => ContinentFixture::OCEANIA_REFERENCE,
        ],
        self::NEW_ZEALAND_REFERENCE => [
            'name' => 'New Zealand',
            'continent' => ContinentFixture::OCEANIA_REFERENCE,
        ],
        self::ARGENTINA_REFERENCE => [
            'name' => 'Argentina',
            'continent' => ContinentFixture::SOUTH_AMERICA_REFERENCE,
        ],
    ];

    #[\Override]
    public function load(ObjectManager $manager): void
    {
        foreach (self::NAME_MAP as $referenceKey => $destination) {
            $destination = $this->createDestination(
                $destination['name'],
                $destination['continent'],
            );

            $manager->persist($destination);

            $this->addReference($referenceKey, $destination);
        }

        $manager->flush();
    }

    private function createDestination(string $name, string $continentKey): Destination
    {
        $destination = new Destination();
        $destination->setDestinationName($name);
        $destination->setImage('images/country_cards/'.$destination->getDestinationName().'_card.jpg');
        $destination->setContinent($this->getContinent($continentKey));

        return $destination;
    }

    /**
     * @return class-string[]
     */
    #[\Override]
    public function getDependencies(): array
    {
        return [ContinentFixture::class];
    }

    public function getContinent(string $referenceKey): Continent
    {
        $continent = $this->getReference($referenceKey);
        \assert($continent instanceof Continent);

        return $continent;
    }
}
