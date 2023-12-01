<?php

namespace App\Entity;

use App\Repository\CoursActionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursActionRepository::class)]
class CoursAction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCoursAction = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\ManyToOne(inversedBy: 'ManyCoursAction')]
    private ?Action $OneAction = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCoursAction(): ?\DateTimeInterface
    {
        return $this->dateCoursAction;
    }

    public function setDateCoursAction(\DateTimeInterface $dateCoursAction): static
    {
        $this->dateCoursAction = $dateCoursAction;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getOneAction(): ?Action
    {
        return $this->OneAction;
    }

    public function setOneAction(?Action $OneAction): static
    {
        $this->OneAction = $OneAction;

        return $this;
    }
}
