<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtsouServiceRepository")
 */
class EtsouService
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
    private $etsouservice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $obs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Personnel", mappedBy="etsouservice")
     */
    private $personnels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AutoAbsence", mappedBy="etsouservice")
     */
    private $autoAbsences;

    public function __construct()
    {
        $this->personnels = new ArrayCollection();
        $this->autoAbsences = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtsouservice(): ?string
    {
        return $this->etsouservice;
    }

    public function setEtsouservice(string $etsouservice): self
    {
        $this->etsouservice = $etsouservice;

        return $this;
    }

    public function getObs(): ?string
    {
        return $this->obs;
    }

    public function setObs(string $obs): self
    {
        $this->obs = $obs;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Personnel[]
     */
    public function getPersonnels(): Collection
    {
        return $this->personnels;
    }

    public function addPersonnel(Personnel $personnel): self
    {
        if (!$this->personnels->contains($personnel)) {
            $this->personnels[] = $personnel;
            $personnel->setEtsouservice($this);
        }

        return $this;
    }

    public function removePersonnel(Personnel $personnel): self
    {
        if ($this->personnels->contains($personnel)) {
            $this->personnels->removeElement($personnel);
            // set the owning side to null (unless already changed)
            if ($personnel->getEtsouservice() === $this) {
                $personnel->setEtsouservice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AutoAbsence[]
     */
    public function getAutoAbsences(): Collection
    {
        return $this->autoAbsences;
    }

    public function addAutoAbsence(AutoAbsence $autoAbsence): self
    {
        if (!$this->autoAbsences->contains($autoAbsence)) {
            $this->autoAbsences[] = $autoAbsence;
            $autoAbsence->setEtsouservice($this);
        }

        return $this;
    }

    public function removeAutoAbsence(AutoAbsence $autoAbsence): self
    {
        if ($this->autoAbsences->contains($autoAbsence)) {
            $this->autoAbsences->removeElement($autoAbsence);
            // set the owning side to null (unless already changed)
            if ($autoAbsence->getEtsouservice() === $this) {
                $autoAbsence->setEtsouservice(null);
            }
        }

        return $this;
    }


}
