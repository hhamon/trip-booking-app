<?php

declare(strict_types=1);

namespace App\Tests\Repository;

use App\Repository\BookingOfferRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class BookingOfferRepositoryTest extends KernelTestCase
{
    public function testFindDistinctDepartureSpots(): void
    {
        $repository = self::getContainer()->get(BookingOfferRepository::class);
        \assert($repository instanceof BookingOfferRepository);

        $this->assertSame(
            [
                'Balice Airport' => 'Balice Airport',
                'Modlin Airport' => 'Modlin Airport',
                'Warsaw Chopin Airport' => 'Warsaw Chopin Airport',
            ],
            $repository->findDistinctDepartureSpots(),
        );
    }
}
