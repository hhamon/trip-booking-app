<?php

namespace App\Service;

use App\Entity\BookingOffer;
use App\Entity\BookingOfferType;
use App\Entity\Destination;
use App\Repository\BookingOfferRepository;

final readonly class BookingOfferService
{
    public function __construct(
        private BookingOfferRepository $itemRepository,
    ) {
    }

    /**
     * @param BookingOfferType[]|null $bookingOfferTypes
     *
     * @return iterable<int, BookingOffer>
     */
    public function findOffers(
        ?string $departureSpot = null,
        Destination|string|int|null $destination = null,
        ?\DateTimeInterface $departureDate = null,
        ?\DateTimeInterface $comebackDate = null,
        float|int|string|null $priceMin = null,
        float|int|string|null $priceMax = null,
        ?array $bookingOfferTypes = null,
    ): iterable {
        return $this->itemRepository->findOffers(
            $departureSpot,
            $destination,
            $departureDate,
            $comebackDate,
            $priceMin,
            $priceMax,
            $bookingOfferTypes,
        );
    }
}
