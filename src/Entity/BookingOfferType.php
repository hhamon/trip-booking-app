<?php

namespace App\Entity;

use App\Repository\BookingOfferTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingOfferTypeRepository::class)]
class BookingOfferType implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    /**
     * @var Collection<int, BookingOffer>
     */
    #[ORM\OneToMany(mappedBy: 'offerType', targetEntity: BookingOffer::class, orphanRemoval: true)]
    private Collection $bookingOffers;

    public function __construct(
        #[ORM\Column]
        private ?string $typeName,
    ) {
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
