<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingOfferRepository")
 */
class BookingOffer
{
    /**
     * @ORM\Id
     *
     * @ORM\GeneratedValue
     *
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $offerName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BookingOfferType", inversedBy="bookingOffers")
     *
     * @ORM\JoinColumn(nullable=false)
     */
    private $offerType;

    /**
     * @ORM\Column(type="integer")
     */
    private $packageId;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $offerPrice;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $childPrice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Destination")
     *
     * @ORM\JoinColumn(nullable=false)
     */
    private $destination;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $bookingStartDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $bookingEndDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $departureDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $comebackDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $departureSpot;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comebackSpot;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFeatured;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photosDirectory;

    private $rating;

    public function __construct()
    {
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating($rating): ?int
    {
        return $this->rating = $rating;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOfferName(): ?string
    {
        return $this->offerName;
    }

    public function setOfferName(string $offerName): self
    {
        $this->offerName = $offerName;

        return $this;
    }

    public function getOfferPrice(): ?float
    {
        return $this->offerPrice;
    }

    public function setOfferPrice(float $offerPrice): self
    {
        $this->offerPrice = $offerPrice;

        return $this;
    }

    public function getChildPrice(): ?float
    {
        return $this->childPrice;
    }

    public function setChildPrice(float $childPrice): self
    {
        $this->childPrice = $childPrice;

        return $this;
    }

    public function getPackageId(): ?int
    {
        return $this->packageId;
    }

    public function setPackageId(int $packageId): self
    {
        $this->packageId = $packageId;

        return $this;
    }

    public function getDestination(): ?Destination
    {
        return $this->destination;
    }

    public function setDestination(?Destination $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBookingStartDate(): ?\DateTimeInterface
    {
        return $this->bookingStartDate;
    }

    public function setBookingStartDate(\DateTimeInterface $bookingStartDate): self
    {
        $this->bookingStartDate = $bookingStartDate;

        return $this;
    }

    public function getBookingEndDate(): ?\DateTimeInterface
    {
        return $this->bookingEndDate;
    }

    public function setBookingEndDate(\DateTimeInterface $bookingEndDate): self
    {
        $this->bookingEndDate = $bookingEndDate;

        return $this;
    }

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->departureDate;
    }

    public function setDepartureDate(?\DateTimeInterface $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    public function getComebackDate(): ?\DateTimeInterface
    {
        return $this->comebackDate;
    }

    public function setComebackDate(?\DateTimeInterface $comebackDate): self
    {
        $this->comebackDate = $comebackDate;

        return $this;
    }

    public function getDepartureSpot(): ?string
    {
        return $this->departureSpot;
    }

    public function setDepartureSpot(string $departureSpot): self
    {
        $this->departureSpot = $departureSpot;

        return $this;
    }

    public function getComebackSpot(): ?string
    {
        return $this->comebackSpot;
    }

    public function setComebackSpot(string $comebackSpot): self
    {
        $this->comebackSpot = $comebackSpot;

        return $this;
    }

    public function getOfferType(): ?BookingOfferType
    {
        return $this->offerType;
    }

    public function setOfferType(?BookingOfferType $offerType): self
    {
        $this->offerType = $offerType;

        return $this;
    }

    public function getIsFeatured(): ?bool
    {
        return $this->isFeatured;
    }

    public function setIsFeatured(bool $isFeatured): self
    {
        $this->isFeatured = $isFeatured;

        return $this;
    }

    public function getPhotosDirectory(): ?string
    {
        return $this->photosDirectory;
    }

    public function setPhotosDirectory(string $photosDirectory): self
    {
        $this->photosDirectory = $photosDirectory;

        return $this;
    }
}
