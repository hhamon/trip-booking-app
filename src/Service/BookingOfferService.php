<?php

namespace App\Service;

use App\Repository\BookingOfferRepository;

final readonly class BookingOfferService
{
    /**
     * ItemService constructor.
     */
    public function __construct(private BookingOfferRepository $itemRepository)
    {
    }

    public function findOffers($departureSpot = null, $destination = null, $departureDate = null, $comebackDate = null, $priceMin = null, $priceMax = null, $bookingOfferTypes = null)
    {
        return $this->itemRepository->findOffers(
            $departureSpot,
            $destination,
            $departureDate,
            $comebackDate,
            $priceMin,
            $priceMax,
            $bookingOfferTypes
        );
    }
}
