<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicamentRepository")
 */
class Medicament
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $denomination;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $conditionnement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LignePrescriptive", mappedBy="medicament")
     */
    private $lignePrescriptives;

    public function __toString()
    {
        return $this->denomination;
    }

    public function __construct()
    {
        $this->lignePrescriptives = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination(string $denomination): self
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getConditionnement(): ?string
    {
        return $this->conditionnement;
    }

    public function setConditionnement(string $conditionnement): self
    {
        $this->conditionnement = $conditionnement;

        return $this;
    }

    /**
     * @return Collection|LignePrescriptive[]
     */
    public function getLignePrescriptives(): Collection
    {
        return $this->lignePrescriptives;
    }

    public function addLignePrescriptive(LignePrescriptive $lignePrescriptive): self
    {
        if (!$this->lignePrescriptives->contains($lignePrescriptive)) {
            $this->lignePrescriptives[] = $lignePrescriptive;
            $lignePrescriptive->setMedicament($this);
        }

        return $this;
    }

    public function removeLignePrescriptive(LignePrescriptive $lignePrescriptive): self
    {
        if ($this->lignePrescriptives->contains($lignePrescriptive)) {
            $this->lignePrescriptives->removeElement($lignePrescriptive);
            // set the owning side to null (unless already changed)
            if ($lignePrescriptive->getMedicament() === $this) {
                $lignePrescriptive->setMedicament(null);
            }
        }

        return $this;
    }
}
