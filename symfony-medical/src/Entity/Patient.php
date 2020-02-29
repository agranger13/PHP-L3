<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 */
class Patient
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
    private $numSS;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $sexe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consultation", mappedBy="numSS", cascade={"persist"})
     */
    private $consultations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ordonnance", mappedBy="patient", cascade={"persist"})
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

    public function getNumSS(): ?string
    {
        return $this->numSS;
    }

    public function setNumSS(string $numSS): self
    {
        $this->numSS = $numSS;

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

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

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
            $consultation->setNumSS($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): self
    {
        if ($this->consultations->contains($consultation)) {
            $this->consultations->removeElement($consultation);
            // set the owning side to null (unless already changed)
            if ($consultation->getNumSS() === $this) {
                $consultation->setNumSS(null);
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
            $ordonnance->setPatient($this);
        }

        return $this;
    }

    public function removeOrdonnance(Ordonnance $ordonnance): self
    {
        if ($this->ordonnance->contains($ordonnance)) {
            $this->ordonnance->removeElement($ordonnance);
            // set the owning side to null (unless already changed)
            if ($ordonnance->getPatient() === $this) {
                $ordonnance->setPatient(null);
            }
        }

        return $this;
    }

}
