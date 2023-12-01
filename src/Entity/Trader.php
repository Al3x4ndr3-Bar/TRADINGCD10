<?php

namespace App\Entity;

use App\Repository\TraderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraderRepository::class)]
class Trader
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\OneToMany(mappedBy: 'OneTrader', targetEntity: transaction::class)]
    private Collection $ManyTransaction;

    public function __construct()
    {
        $this->ManyTransaction = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, transaction>
     */
    public function getManyTransaction(): Collection
    {
        return $this->ManyTransaction;
    }

    public function addManyTransaction(transaction $manyTransaction): static
    {
        if (!$this->ManyTransaction->contains($manyTransaction)) {
            $this->ManyTransaction->add($manyTransaction);
            $manyTransaction->setOneTrader($this);
        }

        return $this;
    }

    public function removeManyTransaction(transaction $manyTransaction): static
    {
        if ($this->ManyTransaction->removeElement($manyTransaction)) {
            // set the owning side to null (unless already changed)
            if ($manyTransaction->getOneTrader() === $this) {
                $manyTransaction->setOneTrader(null);
            }
        }

        return $this;
    }
}
