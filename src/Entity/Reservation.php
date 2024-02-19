<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository", repositoryClass=ReservationRepository::class)
 */
class Reservation
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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     *
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=BookingOffer::class, fetch="EAGER")
     *
     * @ORM\JoinColumn(nullable=false)
     */
    private $bookingOffer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateOfBooking;

    /**
     * @ORM\Column(type="integer")
     */
    private $adultNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $childNumber;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPaidFor;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $bankTransferDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bankTransferTitle;

    private $destination;

    private $totalCost;

    /**
     * @ORM\Column(length=20, nullable=true, unique=true)
     */
    private ?string $invoiceNumber = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBookingOffer(): ?BookingOffer
    {
        return $this->bookingOffer;
    }

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

    public function getChildNumber(): ?int
    {
        return $this->childNumber;
    }

    public function setChildNumber(?int $childNumber): self
    {
        $this->childNumber = $childNumber;

        return $this;
    }

    public function getAdultNumber(): ?int
    {
        return $this->adultNumber;
    }

    public function setAdultNumber(?int $adultNumber): self
    {
        $this->adultNumber = $adultNumber;

        return $this;
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

    public function generateRandomString($length = 15)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
}
