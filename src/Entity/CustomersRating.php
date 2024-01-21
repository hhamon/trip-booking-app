<?php

namespace App\Entity;

use App\Repository\CustomersRatingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomersRatingRepository::class)]
class CustomersRating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::INTEGER)]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: user::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::INTEGER)]
    private ?int $package = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::INTEGER)]
    private ?int $rating = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 255, nullable: true)]
    private ?string $comment = null;

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

    public function getPackage(): ?int
    {
        return $this->package;
    }

    public function setPackage(?int $packageId): self
    {
        $this->package = $packageId;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
