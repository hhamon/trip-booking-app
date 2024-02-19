<?php

namespace App\Entity;

use App\Repository\CareerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CareerRepository::class)]
class Career
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $jobTitle;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $requirements;

    #[ORM\Column(type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private $salary;

    #[ORM\Column(type: 'datetime')]
    private $recruitmentStartDate;

    #[ORM\Column(type: 'datetime')]
    private $recruitmentEndDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJobTitle(): ?string
    {
        return $this->jobTitle;
    }

    public function setJobTitle(string $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRequirements(): ?string
    {
        return $this->requirements;
    }

    public function setRequirements(string $requirements): self
    {
        $this->requirements = $requirements;

        return $this;
    }

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(string $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getRecruitmentStartDate(): ?\DateTimeInterface
    {
        return $this->recruitmentStartDate;
    }

    public function setRecruitmentStartDate(\DateTimeInterface $recruitmentStartDate): self
    {
        $this->recruitmentStartDate = $recruitmentStartDate;

        return $this;
    }

    public function getRecruitmentEndDate(): ?\DateTimeInterface
    {
        return $this->recruitmentEndDate;
    }

    public function setRecruitmentEndDate(\DateTimeInterface $recruitmentEndDate): self
    {
        $this->recruitmentEndDate = $recruitmentEndDate;

        return $this;
    }
}
