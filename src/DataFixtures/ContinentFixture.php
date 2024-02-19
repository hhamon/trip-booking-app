<?php

namespace App\DataFixtures;

use App\Entity\Continent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContinentFixture extends Fixture
{
    public const AFRICA_REFERENCE = 'africa';

    public const ANTARCTICA_REFERENCE = 'antarctica';

    public const ASIA_REFERENCE = 'asia';

    public const OCEANIA_REFERENCE = 'oceania';

    public const EUROPE_REFERENCE = 'europe';

    public const NORTH_AMERICA_REFERENCE = 'north america';

    public const SOUTH_AMERICA_REFERENCE = 'south america';

    public function load(ObjectManager $manager): void
    {
        $continent = $this->createContinent('Africa');
        $this->addReference(self::AFRICA_REFERENCE, $continent);
        $manager->persist($continent);

        $continent = $this->createContinent('Antarctica');
        $this->addReference(self::ANTARCTICA_REFERENCE, $continent);
        $manager->persist($continent);

        $continent = $this->createContinent('Asia');
        $this->addReference(self::ASIA_REFERENCE, $continent);
        $manager->persist($continent);

        $continent = $this->createContinent('Australia');
        $this->addReference(self::OCEANIA_REFERENCE, $continent);
        $manager->persist($continent);

        $continent = $this->createContinent('Europe');
        $this->addReference(self::EUROPE_REFERENCE, $continent);
        $manager->persist($continent);

        $continent = $this->createContinent('North America');
        $this->addReference(self::NORTH_AMERICA_REFERENCE, $continent);
        $manager->persist($continent);

        $continent = $this->createContinent('South America');
        $this->addReference(self::SOUTH_AMERICA_REFERENCE, $continent);
        $manager->persist($continent);

        $manager->flush();
    }

    private function createContinent(string $name): Continent
    {
        $continent = new Continent();
        $continent->setName($name);

        return $continent;
    }
}
