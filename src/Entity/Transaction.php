<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateTransaction = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column(length: 255)]
    private ?string $operation = null;

    #[ORM\ManyToOne(inversedBy: 'ManyTransaction')]
    private ?Trader $OneTrader = null;

    #[ORM\ManyToOne(inversedBy: 'ManyTransaction')]
    private ?Action $OneAction = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTransaction(): ?\DateTimeInterface
    {
        return $this->dateTransaction;
    }

    public function setDateTransaction(\DateTimeInterface $dateTransaction): static
    {
        $this->dateTransaction = $dateTransaction;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getOperation(): ?string
    {
        return $this->operation;
    }

    public function setOperation(string $operation): static
    {
        $this->operation = $operation;

        return $this;
    }

    public function getOneTrader(): ?Trader
    {
        return $this->OneTrader;
    }

    public function setOneTrader(?Trader $OneTrader): static
    {
        $this->OneTrader = $OneTrader;

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
