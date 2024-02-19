<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\Destination;
use App\Repository\DestinationRepository;
use Symfony\Component\Panther\PantherTestCase;

final class OfferControllerTest extends PantherTestCase
{
    public function testSearchTravelOffers(): void
    {
        $destination = $this->getDestination('Argentina');

        $departureDate = (new \DateTimeImmutable('+10 days'))->format('d/m/Y');

        $client = self::createPantherClient();
        $client->followRedirects();

        $client->request('GET', '/');
        $client->submitForm('booking_offer_search_submit', [
            'booking_offer_search[departureSpot]' => 'Warsaw Chopin Airport',
            'booking_offer_search[destination]' => (int) $destination->getId(),
            'booking_offer_search[departureDate]' => $departureDate,
        ]);

        $this->assertPageTitleContains('Browse Offers - Dream Holiday');

        // Check search results
        $this->assertSelectorCount(1, '.offer-table-row');
        $this->assertSelectorTextContains('.offer-table-row:first-child .offer-name', 'H- Patagonia');

        // Check sidebar filters are prefilled
        $this->assertFormValue('form[name="booking_offer_filters"]', 'booking_offer_filters[departureDate]', $departureDate);
        $this->assertFormValue('form[name="booking_offer_filters"]', 'booking_offer_filters[departureSpot]', 'Warsaw Chopin Airport');
        $this->assertFormValue('form[name="booking_offer_filters"]', 'booking_offer_filters[destination]', (string) $destination->getId());
    }

    private function getDestination(string $name): Destination
    {
        $destinationRepository = self::getContainer()->get(DestinationRepository::class);
        \assert($destinationRepository instanceof DestinationRepository);

        $destination = $destinationRepository->findOneBy(['destinationName' => $name]);
        \assert($destination instanceof Destination);

        return $destination;
    }
}
