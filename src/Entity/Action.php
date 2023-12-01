<?php

namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActionRepository::class)]
class Action
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\OneToMany(mappedBy: 'OneAction', targetEntity: transaction::class)]
    private Collection $ManyTransaction;

    #[ORM\OneToMany(mappedBy: 'OneAction', targetEntity: coursaction::class)]
    private Collection $ManyCoursAction;

    public function __construct()
    {
        $this->ManyTransaction = new ArrayCollection();
        $this->ManyCoursAction = new ArrayCollection();
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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

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
            $manyTransaction->setOneAction($this);
        }

        return $this;
    }

    public function removeManyTransaction(transaction $manyTransaction): static
    {
        if ($this->ManyTransaction->removeElement($manyTransaction)) {
            // set the owning side to null (unless already changed)
            if ($manyTransaction->getOneAction() === $this) {
                $manyTransaction->setOneAction(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, coursaction>
     */
    public function getManyCoursAction(): Collection
    {
        return $this->ManyCoursAction;
    }

    public function addManyCoursAction(coursaction $manyCoursAction): static
    {
        if (!$this->ManyCoursAction->contains($manyCoursAction)) {
            $this->ManyCoursAction->add($manyCoursAction);
            $manyCoursAction->setOneAction($this);
        }

        return $this;
    }

    public function removeManyCoursAction(coursaction $manyCoursAction): static
    {
        if ($this->ManyCoursAction->removeElement($manyCoursAction)) {
            // set the owning side to null (unless already changed)
            if ($manyCoursAction->getOneAction() === $this) {
                $manyCoursAction->setOneAction(null);
            }
        }

        return $this;
    }

    public function getDernierPrixAction(): int 
    {
        $resultat = 0;
        foreach ($this->$ManyCoursAction as $oneAction)
        {
            $resultat = $oneAction->getPrix();
        }
        return $resultat;
    }
    
}
