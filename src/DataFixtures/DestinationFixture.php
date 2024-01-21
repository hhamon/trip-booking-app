<?php

namespace App\DataFixtures;

use App\Entity\Destination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DestinationFixture extends Fixture implements DependentFixtureInterface
{
    final public const SPAIN_REFERENCE = 'spain';
    final public const TURKEY_REFERENCE = 'turkey';
    final public const INDIA_REFERENCE = 'india';
    final public const JAPAN_REFERENCE = 'japan';
    final public const AUSTRALIA_REFERENCE = 'australia';
    final public const NEW_ZEALAND_REFERENCE = 'new_zealand';
    final public const ITALY_REFERENCE = 'italy';
    final public const THAILAND_REFERENCE = 'thailand';
    final public const CHINA_REFERENCE = 'china';
    final public const ARGENTINA_REFERENCE = 'argentina';

    #[\Override]
    public function load(ObjectManager $manager)
    {
        $destination = $this->createDestination('Spain',
            $this->getReference(ContinentFixture::EUROPE_REFERENCE));
        $this->addReference(self::SPAIN_REFERENCE, $destination);
        $manager->persist($destination);

        $destination = $this->createDestination('Turkey',
            $this->getReference(ContinentFixture::ASIA_REFERENCE));
        $this->addReference(self::TURKEY_REFERENCE, $destination);
        $manager->persist($destination);

        $destination = $this->createDestination('India',
            $this->getReference(ContinentFixture::ASIA_REFERENCE));
        $this->addReference(self::INDIA_REFERENCE, $destination);
        $manager->persist($destination);

        $destination = $this->createDestination('Japan',
            $this->getReference(ContinentFixture::ASIA_REFERENCE));
        $this->addReference(self::JAPAN_REFERENCE, $destination);
        $manager->persist($destination);

        $destination = $this->createDestination('Australia',
            $this->getReference(ContinentFixture::OCEANIA_REFERENCE));
        $this->addReference(self::AUSTRALIA_REFERENCE, $destination);
        $manager->persist($destination);

        $destination = $this->createDestination('New Zealand',
            $this->getReference(ContinentFixture::OCEANIA_REFERENCE));
        $this->addReference(self::NEW_ZEALAND_REFERENCE, $destination);
        $manager->persist($destination);

        $destination = $this->createDestination('Italy',
            $this->getReference(ContinentFixture::EUROPE_REFERENCE));
        $this->addReference(self::ITALY_REFERENCE, $destination);
        $manager->persist($destination);

        $destination = $this->createDestination('Thailand',
            $this->getReference(ContinentFixture::ASIA_REFERENCE));
        $this->addReference(self::THAILAND_REFERENCE, $destination);
        $manager->persist($destination);

        $destination = $this->createDestination('China',
            $this->getReference(ContinentFixture::ASIA_REFERENCE));
        $this->addReference(self::CHINA_REFERENCE, $destination);
        $manager->persist($destination);

        $destination = $this->createDestination('Argentina',
            $this->getReference(ContinentFixture::SOUTH_AMERICA_REFERENCE));
        $this->addReference(self::ARGENTINA_REFERENCE, $destination);
        $manager->persist($destination);

        $manager->flush();
    }

    private function createDestination($name, $continent): Destination
    {
        $destination = new Destination();
        $destination->setDestinationName($name);
        $destination->setImage('images/country_cards/'.$destination->getDestinationName().'_card.jpg');
        $destination->setContinent($continent);

        return $destination;
    }

    #[\Override]
    public function getDependencies()
    {
        return [ContinentFixture::class];
    }
}
