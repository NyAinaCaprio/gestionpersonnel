<?php

namespace App\Entity;

class PersonnelSearch
{

    /**
     * @var string|null
     */
    private $nomprenom;

    /**
     * @var int|null
     */
    private $etsouservice;

    /**
     * @var int|null
     */
    private $categorie;

    /**
     * @var int|null
     */
    private $detachement;

    /**
     * @return null|string
     */
    public function getNomprenom(): ?string
    {
        return $this->nomprenom;
    }

    /**
     * @param null|string $nomprenom
     * @return PersonnelSearch
     */
    public function setNomprenom(string $nomprenom): PersonnelSearch
    {
        $this->nomprenom = $nomprenom;
        return $this;
    }

    /**
     * @return EtsouService|null
     */
    public function getEtsouservice(): ?EtsouService
    {
        return $this->etsouservice;
    }

    /**
     * @param EtsouService $etsouservice
     * @return EtsouService
     */
    public function setEtsouservice(EtsouService $etsouservice): PersonnelSearch
    {
        $this->etsouservice = $etsouservice;
        return $this;
    }

    /**
     * @return Categorie|null
     */
    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    /**
     * @param Categorie $categorie
     * @return PersonnelSearch
     */
    public function setCategorie(Categorie $categorie): PersonnelSearch
    {
        $this->categorie = $categorie;
        return $this;
    }

    /**
     * @return Detachement|null
     */
    public function getDetachement(): ?Detachement
    {
        return $this->detachement;
    }

    /**
     * @param int|null $detachement
     * @return PersonnelSearch
     */
    public function setDetachement(Detachement $detachement): PersonnelSearch
    {
        $this->detachement = $detachement;
        return $this;
    }




}
