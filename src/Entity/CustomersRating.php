<?php

namespace App\Entity;

use App\Repository\CustomersRatingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomersRatingRepository::class)]
class CustomersRating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $package = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $rating = null;

    #[ORM\Column]
    private ?string $comment = null;

    public static function authoredBy(
        User $author,
        int $packageId,
        int $rating,
        ?string $comment = null,
    ): self {
        $comment = null !== $comment ? \trim($comment) : null;

        $instance = new self();
        $instance->user = $author;
        $instance->package = $packageId;
        $instance->rating = $rating;
        $instance->comment = $comment ?? null;

        return $instance;
    }

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
