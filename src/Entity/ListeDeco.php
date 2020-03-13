<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ListeDecoRepository")
 */
class ListeDeco
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $decoration;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $libelle;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="integer")
     */
    private $anneeservice;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Decoration", mappedBy="listedeco")
     */
    private $decorations;

    public function __construct()
    {
        $this->decorations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDecoration(): ?string
    {
        return $this->decoration;
    }

    public function setDecoration(string $decoration): self
    {
        $this->decoration = $decoration;

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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getAnneeservice(): ?int
    {
        return $this->anneeservice;
    }

    public function setAnneeservice(int $anneeservice): self
    {
        $this->anneeservice = $anneeservice;

        return $this;
    }

    /**
     * @return Collection|Decoration[]
     */
    public function getDecorations(): Collection
    {
        return $this->decorations;
    }

    public function addDecoration(Decoration $decoration): self
    {
        if (!$this->decorations->contains($decoration)) {
            $this->decorations[] = $decoration;
            $decoration->setListedeco($this);
        }

        return $this;
    }

    public function removeDecoration(Decoration $decoration): self
    {
        if ($this->decorations->contains($decoration)) {
            $this->decorations->removeElement($decoration);
            // set the owning side to null (unless already changed)
            if ($decoration->getListedeco() === $this) {
                $decoration->setListedeco(null);
            }
        }

        return $this;
    }
}
