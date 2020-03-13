<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetacheRepository")
 */
class Detache
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
    private $detache;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDetache(): ?string
    {
        return $this->detache;
    }

    public function setDetache(string $detache): self
    {
        $this->detache = $detache;

        return $this;
    }
}
