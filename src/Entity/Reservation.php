<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\ManyToOne(targetEntity: BookingOffer::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    private BookingOffer $bookingOffer;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $dateOfBooking = null;

    #[ORM\Column(type: 'integer')]
    private int $adultNumber;

    #[ORM\Column(type: 'integer')]
    private int $childNumber;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isPaidFor = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $bankTransferDate = null;

    #[ORM\Column(type: 'string', length: 255)]
    private $bankTransferTitle;

    private ?string $destination = null;

    private ?float $totalCost = null;

    #[ORM\Column(length: 20, nullable: true, unique: true)]
    private ?string $invoiceNumber = null;

    public function __construct(
        User $owner,
        BookingOffer $offer,
        int $adultNumber = 2,
        int $childNumber = 0,
        ?float $totalCost = null,
    ) {
        if ($adultNumber < 1) {
            throw new \DomainException('Reservation must have at least 1 adult.');
        }

        if ($adultNumber > 10) {
            throw new \DomainException('Reservation cannot be taken for more than 10 adults.');
        }

        $this->user = $owner;
        $this->bookingOffer = $offer;
        $this->adultNumber = $adultNumber;
        $this->childNumber = $childNumber;
        $this->totalCost = $totalCost;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @deprecated to be removed soon
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBookingOffer(): BookingOffer
    {
        return $this->bookingOffer;
    }

    /**
     * @deprecated to be removed soon
     */
    public function setBookingOffer(?BookingOffer $bookingOffer): self
    {
        $this->bookingOffer = $bookingOffer;

        return $this;
    }

    public function getDateOfBooking(): ?\DateTimeInterface
    {
        return $this->dateOfBooking;
    }

    public function setDateOfBooking(?\DateTimeInterface $dateOfBooking): self
    {
        $this->dateOfBooking = $dateOfBooking;

        return $this;
    }

    public function getIsPaidFor(): ?bool
    {
        return $this->isPaidFor;
    }

    public function setIsPaidFor(?bool $isPaidFor): self
    {
        $this->isPaidFor = $isPaidFor;

        return $this;
    }

    public function getBankTransferDate(): ?\DateTimeInterface
    {
        return $this->bankTransferDate;
    }

    public function setBankTransferDate(?\DateTimeInterface $bankTransferDate): self
    {
        $this->bankTransferDate = $bankTransferDate;

        return $this;
    }

    public function getChildNumber(): int
    {
        return $this->childNumber;
    }

    public function getAdultNumber(): int
    {
        return $this->adultNumber;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(?string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getTotalCost(): ?float
    {
        return $this->totalCost;
    }

    public function setTotalCost(?float $totalCost): self
    {
        $this->totalCost = $totalCost;

        return $this;
    }

    public function getBankTransferTitle(): ?string
    {
        return $this->bankTransferTitle;
    }

    public function setBankTransferTitle(): self
    {
        $this->bankTransferTitle = $this->generateRandomString();

        return $this;
    }

    public function generateRandomString($length = 15): string
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public function preConfirm(
        \DateTime $bookedAt = new \DateTime('NOW'),
    ): void {
        $this->setDateOfBooking($bookedAt);
        $this->setIsPaidFor(false);
    }

    public function cancel(
        \DateTime $canceledAt = new \DateTime('NOW'),
    ): void {
    }
}
