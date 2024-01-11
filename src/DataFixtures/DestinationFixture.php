<?php

namespace App\DataFixtures;

use App\Entity\Destination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DestinationFixture extends Fixture implements DependentFixtureInterface
{
    public const SPAIN_REFERENCE = 'spain';
    public const TURKEY_REFERENCE = 'turkey';
    public const INDIA_REFERENCE = 'india';
    public const JAPAN_REFERENCE = 'japan';
    public const AUSTRALIA_REFERENCE = 'australia';
    public const NEW_ZEALAND_REFERENCE = 'new_zealand';
    public const ITALY_REFERENCE = 'italy';
    public const THAILAND_REFERENCE = 'thailand';
    public const CHINA_REFERENCE = 'china';
    public const ARGENTINA_REFERENCE = 'argentina';
    public function load(ObjectManager $manager)
    {

        $destination = $this->createDestination('Spain',
            $this->getReference(ContinentFixture::EUROPE_REFERENCE));
        $this->addReference(self::SPAIN_REFERENCE,$destination);
        $manager->persist($destination);


        $destination = $this->createDestination('Turkey',
            $this->getReference(ContinentFixture::ASIA_REFERENCE));
        $this->addReference(self::TURKEY_REFERENCE,$destination);
        $manager->persist($destination);


        $destination = $this->createDestination('India',
            $this->getReference(ContinentFixture::ASIA_REFERENCE));
        $this->addReference(self::INDIA_REFERENCE,$destination);
        $manager->persist($destination);


        $destination = $this->createDestination('Japan',
            $this->getReference(ContinentFixture::ASIA_REFERENCE));
        $this->addReference(self::JAPAN_REFERENCE,$destination);
        $manager->persist($destination);


        $destination = $this->createDestination('Australia',
            $this->getReference(ContinentFixture::OCEANIA_REFERENCE));
        $this->addReference(self::AUSTRALIA_REFERENCE,$destination);
        $manager->persist($destination);


        $destination = $this->createDestination('New Zealand',
            $this->getReference(ContinentFixture::OCEANIA_REFERENCE));
        $this->addReference(self::NEW_ZEALAND_REFERENCE,$destination);
        $manager->persist($destination);


        $destination = $this->createDestination('Italy',
            $this->getReference(ContinentFixture::EUROPE_REFERENCE));
        $this->addReference(self::ITALY_REFERENCE,$destination);
        $manager->persist($destination);


        $destination = $this->createDestination('Thailand',
            $this->getReference(ContinentFixture::ASIA_REFERENCE));
        $this->addReference(self::THAILAND_REFERENCE,$destination);
        $manager->persist($destination);


        $destination = $this->createDestination('China',
            $this->getReference(ContinentFixture::ASIA_REFERENCE));
        $this->addReference(self::CHINA_REFERENCE,$destination);
        $manager->persist($destination);


        $destination = $this->createDestination('Argentina',
            $this->getReference(ContinentFixture::SOUTH_AMERICA_REFERENCE));
        $this->addReference(self::ARGENTINA_REFERENCE,$destination);
        $manager->persist($destination);


        $manager->flush();
    }

    private function createDestination($name, $continent) :Destination
    {
        $destination = new Destination();
        $destination->setDestinationName($name);
        $destination->setImage('images/country_cards/' . $destination->getDestinationName() . '_card.jpg');
        $destination->setContinent($continent);
        return $destination;
    }

    public function getDependencies()
    {
        return [ContinentFixture::class];
    }
}
