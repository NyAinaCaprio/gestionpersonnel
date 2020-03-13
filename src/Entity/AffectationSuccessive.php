<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AffectationSuccessiveRepository")
 */
class AffectationSuccessive
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieuaffect;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fonctiontenue;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateeffet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personnel", inversedBy="affectationSuccessives")
     */
    private $personnel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $detachement;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieuaffect(): ?string
    {
        return $this->lieuaffect;
    }

    public function setLieuaffect(?string $lieuaffect): self
    {
        $this->lieuaffect = $lieuaffect;

        return $this;
    }


    public function getFonctiontenue(): ?string
    {
        return $this->fonctiontenue;
    }

    public function setFonctiontenue(?string $fonctiontenue): self
    {
        $this->fonctiontenue = $fonctiontenue;

        return $this;
    }

    public function getDateeffet(): ?\DateTimeInterface
    {
        return $this->dateeffet;
    }

    public function setDateeffet(?\DateTimeInterface $dateeffet): self
    {
        $this->dateeffet = $dateeffet;

        return $this;
    }

    public function getPersonnel(): ?Personnel
    {
        return $this->personnel;
    }

    public function setPersonnel(?Personnel $personnel): self
    {
        $this->personnel = $personnel;

        return $this;
    }

    public function getDetachement(): ?string
    {
        return $this->detachement;
    }

    public function setDetachement(?string $detachement): self
    {
        $this->detachement = $detachement;

        return $this;
    }

}
