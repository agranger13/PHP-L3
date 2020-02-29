<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedecinRepository")
 */
class Medecin
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
    private $matricule;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consultation", mappedBy="matricule", cascade={"persist"})
     */
    private $consultations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ordonnance", mappedBy="medecin", cascade={"persist"})
     */
    private $ordonnance;

    public function __construct()
    {
        $this->consultations = new ArrayCollection();
        $this->ordonnance = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection|Consultation[]
     */
    public function getConsultations(): Collection
    {
        return $this->consultations;
    }

    public function addConsultation(Consultation $consultation): self
    {
        if (!$this->consultations->contains($consultation)) {
            $this->consultations[] = $consultation;
            $consultation->setMatricule($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): self
    {
        if ($this->consultations->contains($consultation)) {
            $this->consultations->removeElement($consultation);
            // set the owning side to null (unless already changed)
            if ($consultation->getMatricule() === $this) {
                $consultation->setMatricule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ordonnance[]
     */
    public function getOrdonnance(): Collection
    {
        return $this->ordonnance;
    }

    public function addOrdonnance(Ordonnance $ordonnance): self
    {
        if (!$this->ordonnance->contains($ordonnance)) {
            $this->ordonnance[] = $ordonnance;
            $ordonnance->setMedecin($this);
        }

        return $this;
    }

    public function removeOrdonnance(Ordonnance $ordonnance): self
    {
        if ($this->ordonnance->contains($ordonnance)) {
            $this->ordonnance->removeElement($ordonnance);
            // set the owning side to null (unless already changed)
            if ($ordonnance->getMedecin() === $this) {
                $ordonnance->setMedecin(null);
            }
        }

        return $this;
    }

    
}
