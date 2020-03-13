<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DecorationRepository")
 */
class Decoration
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
    private $decretouarrete;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ListeDeco", inversedBy="decorations")
     */
    private $listedeco;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personnel", inversedBy="decoration", cascade={"persist"})
     */
    private $personnel;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDecretouarrete(): ?string
    {
        return $this->decretouarrete;
    }

    public function setDecretouarrete(string $decretouarrete): self
    {
        $this->decretouarrete = $decretouarrete;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getListedeco(): ?ListeDeco
    {
        return $this->listedeco;
    }

    public function setListedeco(?ListeDeco $listedeco): self
    {
        $this->listedeco = $listedeco;

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

}
