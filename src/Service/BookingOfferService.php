<?php


namespace App\Service;


use App\Repository\BookingOfferRepository;

final class BookingOfferService
{
    private $itemRepository;

    /**
     * ItemService constructor.
     * @param BookingOfferRepository $bookingOfferRepository
     */
    public function __construct(BookingOfferRepository $bookingOfferRepository)
    {
        $this->itemRepository = $bookingOfferRepository;
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