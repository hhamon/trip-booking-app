<?php

namespace App\Entity;

use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DestinationRepository::class)]
class Destination implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $destinationName = null;

    /**
     * @Assert\File(mimeTypes={ "image/jpeg", "image/jpg", "image/png"},
     *              maxSize = "1024k")
     */
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(targetEntity: Continent::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Continent $continent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDestinationName(): ?string
    {
        return $this->destinationName;
    }

    public function setDestinationName(string $destinationName): self
    {
        $this->destinationName = $destinationName;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getContinent(): ?Continent
    {
        return $this->continent;
    }

    public function setContinent(?Continent $continent): self
    {
        $this->continent = $continent;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->destinationName;
    }

    /**
     * @throws \Exception
     */
    public static function sortDestinationsByName(array $destinations): array
    {
        $doctrineDestinationCollection = new ArrayCollection($destinations);
        $iterator = $doctrineDestinationCollection->getIterator();
        $iterator->uasort(static fn ($d1, $d2): int => (strtolower((string) $d1->getDestinationName()) < strtolower((string) $d2->getDestinationName())) ? -1 : 1);

        return iterator_to_array($iterator);
    }
}
