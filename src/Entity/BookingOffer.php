<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\BookingOfferRepository::class)]
class BookingOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 255)]
    private ?string $offerName = null;

    #[ORM\ManyToOne(targetEntity: BookingOfferType::class, inversedBy: 'bookingOffers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BookingOfferType $offerType = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::INTEGER)]
    private ?int $packageId = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $offerPrice = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $childPrice = null;

    #[ORM\ManyToOne(targetEntity: Destination::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Destination $destination = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $bookingStartDate = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $bookingEndDate = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $departureDate = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $comebackDate = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 255)]
    private ?string $departureSpot = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 255)]
    private ?string $comebackSpot = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::BOOLEAN)]
    private ?bool $isFeatured = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 255)]
    private ?string $photosDirectory = null;

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
