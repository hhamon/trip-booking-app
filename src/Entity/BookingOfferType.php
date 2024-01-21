<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\BookingOfferTypeRepository::class)]
class BookingOfferType implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 255)]
    private ?string $typeName = null;

    /**
     * @var \Doctrine\Common\Collections\Collection<int, \App\Entity\BookingOffer>
     */
    #[ORM\OneToMany(targetEntity: BookingOffer::class, mappedBy: 'offerType', orphanRemoval: true)]
    private Collection $bookingOffers;

    public function __construct()
    {
        $this->bookingOffers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeName(): ?string
    {
        return $this->typeName;
    }

    public function setTypeName(string $typeName): self
    {
        $this->typeName = $typeName;

        return $this;
    }

    /**
     * @return Collection|BookingOffer[]
     */
    public function getBookingOffers(): Collection
    {
        return $this->bookingOffers;
    }

    public function addBookingOffer(BookingOffer $bookingOffer): self
    {
        if (!$this->bookingOffers->contains($bookingOffer)) {
            $this->bookingOffers[] = $bookingOffer;
            $bookingOffer->setOfferType($this);
        }

        return $this;
    }

    public function removeBookingOffer(BookingOffer $bookingOffer): self
    {
        if ($this->bookingOffers->contains($bookingOffer)) {
            $this->bookingOffers->removeElement($bookingOffer);
            // set the owning side to null (unless already changed)
            if ($bookingOffer->getOfferType() === $this) {
                $bookingOffer->setOfferType(null);
            }
        }

        return $this;
    }

    #[\Override]
    public function __toString(): string
    {
        return (string) $this->typeName;
    }
}
