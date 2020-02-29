<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdonnanceRepository")
 */
class Ordonnance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $numeroOrdre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateHeure;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="ordonnance")
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Medecin", inversedBy="ordonnance")
     */
    private $medecin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LignePrescriptive", mappedBy="ordonnance")
     */
    private $lignePrescriptives;

    public function __construct()
    {
        $this->lignePrescriptives = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroOrdre(): ?string
    {
        return $this->numeroOrdre;
    }

    public function setNumeroOrdre(string $numeroOrdre): self
    {
        $this->numeroOrdre = $numeroOrdre;

        return $this;
    }

    public function getDateHeure(): ?\DateTimeInterface
    {
        return $this->dateHeure;
    }

    public function setDateHeure(\DateTimeInterface $dateHeure): self
    {
        $this->dateHeure = $dateHeure;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): self
    {
        $this->medecin = $medecin;

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
            $lignePrescriptive->setOrdonnance($this);
        }

        return $this;
    }

    public function removeLignePrescriptive(LignePrescriptive $lignePrescriptive): self
    {
        if ($this->lignePrescriptives->contains($lignePrescriptive)) {
            $this->lignePrescriptives->removeElement($lignePrescriptive);
            // set the owning side to null (unless already changed)
            if ($lignePrescriptive->getOrdonnance() === $this) {
                $lignePrescriptive->setOrdonnance(null);
            }
        }

        return $this;
    }

    
}
