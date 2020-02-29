<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LignePrescriptiveRepository")
 */
class LignePrescriptive
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $posologie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ordonnance", inversedBy="lignePrescriptives")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ordonnance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Medicament", inversedBy="lignePrescriptives")
     * @ORM\JoinColumn(nullable=false)
     */
    private $medicament;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosologie(): ?string
    {
        return $this->posologie;
    }

    public function setPosologie(string $posologie): self
    {
        $this->posologie = $posologie;

        return $this;
    }

    public function getOrdonnance(): ?Ordonnance
    {
        return $this->ordonnance;
    }

    public function setOrdonnance(?Ordonnance $ordonnance): self
    {
        $this->ordonnance = $ordonnance;

        return $this;
    }

    public function getMedicament(): ?Medicament
    {
        return $this->medicament;
    }

    public function setMedicament(?Medicament $medicament): self
    {
        $this->medicament = $medicament;

        return $this;
    }

   
}
