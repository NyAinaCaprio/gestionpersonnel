<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Cocur\Slugify\Slugify;
/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonnelRepository")
 * @UniqueEntity("cin")
 * @Vich\Uploadable()
 */
class Personnel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="personnel_image", fileNameProperty="filename")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="5", max="255")
     * @ORM\Column(type="string", length=255)
     *
     */
    private $nomprenom;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank
     */
    private $sexe;


    /**
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/^[a-zA-Z]+$/i")
     * @ORM\Column(type="string", length=12)
     */
    private $cin;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $delivrele;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=50)
     */
    private $a;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $adresseactuelle;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=200, nullable=true)
     * @Assert\Email(message = "cet adresse email '{{ value }}' n'est pas valide.")
     */
    private $adresseMail;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $situationmatrimoniale;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $groupesanguin;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $groupeethnique;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $religion;

    /**
     * @Assert\Regex("/^[0-9]{10}/")
     * @ORM\Column(type="string", length=10, nullable=true)
     *
     *
     */
    private $telephone;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @return null|string
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param null|string $filename
     * @return Personnel
     */
    public function setFilename(?string $filename): Personnel
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTimeInterface|null
     */
    private $updated_at;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EtsouService", inversedBy="personnels")
     * 
     */
    private $etsouservice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="personnels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;




    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AffectationSuccessive", mappedBy="personnel", cascade={"persist"})
     * 
     */
    private $affectationSuccessives;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Avancement", mappedBy="personnel", cascade={"persist"})
     * 
     */
    private $avancements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Decoration", mappedBy="personnel", cascade={"persist"})
     * 
     */
    private $decoration;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Enfant", mappedBy="personnel", cascade={"persist"})
     * 
     */
    private $enfants;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ecole", mappedBy="personnel", cascade={"persist"})
     * 
     */
    private $ecoles;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $rupture = "En activité";

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Detachement", inversedBy="personnels")
     */
    private $detachement;


    /**
     * @ORM\Column(type="date")
     */
    private $datenaisse;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRetraite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Direction", inversedBy="personnels")
     */
    private $direction;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Search", mappedBy="Personnel")
     */
    private $searches;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $affectionactuelle;

    /**
     * @ORM\Column(type="integer", nullable=true, length=6)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $fonction;

    /**
     * @ORM\Column(type="date")
     */
    private $daterecrute;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $indice;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $interruptiondu;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $au;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $sortantecole;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomconjoint;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datemariage;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaissConj;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lieuNaissConj;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $bureautique;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $autres;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $francais;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $anglais;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $autresLangue;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $NumPermis;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $permisDelivrele;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lieuDelivrance;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $permisCategorie;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $autresPermis;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AutoAbsence", mappedBy="personnel")
     */
    private $autoAbsences;



    public function __construct()
    {

        $this->affectationSuccessives = new ArrayCollection();
        $this->avancements = new ArrayCollection();
        $this->decoration = new ArrayCollection();
        $this->enfants = new ArrayCollection();
        $this->ecoles = new ArrayCollection();
        $this->updated_at = new \DateTime('now');
        $this->searches = new ArrayCollection();
        $this->autoAbsences = new ArrayCollection();
    }



     public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomprenom(): ?string
    {
        return $this->nomprenom;
    }

    public function setNomprenom(string $nomprenom): self
    {
        $this->nomprenom = $nomprenom;

        return $this;
    }

    public function getSlug()
    {
        $slugify = new Slugify();
        return $slugify->slugify($this->nomprenom); // Tina-Heriniaina
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }



    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getDelivrele(): ?\DateTimeInterface
    {
        return $this->delivrele;
    }

    public function setDelivrele(\DateTimeInterface $delivrele): self
    {
        $this->delivrele = $delivrele;

        return $this;
    }

    public function getA(): ?string
    {
        return $this->a;
    }

    public function setA(string $a): self
    {
        $this->a = $a;

        return $this;
    }

    public function getAdresseactuelle(): ?string
    {
        return $this->adresseactuelle;
    }

    public function setAdresseactuelle(string $adresseactuelle): self
    {
        $this->adresseactuelle = $adresseactuelle;

        return $this;
    }

    public function getAdresseMail(): ?string
    {
        return $this->adresseMail;
    }

    public function setAdresseMail(?string $adresseMail): self
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }

    public function getSituationmatrimoniale(): ?string
    {
        return $this->situationmatrimoniale;
    }

    public function setSituationmatrimoniale(string $situationmatrimoniale): self
    {
        $this->situationmatrimoniale = $situationmatrimoniale;

        return $this;
    }

    public function getGroupesanguin(): ?string
    {
        return $this->groupesanguin;
    }

    public function setGroupesanguin(?string $groupesanguin): self
    {
        $this->groupesanguin = $groupesanguin;

        return $this;
    }

    public function getGroupeethnique(): ?string
    {
        return $this->groupeethnique;
    }

    public function setGroupeethnique(?string $groupeethnique): self
    {
        $this->groupeethnique = $groupeethnique;

        return $this;
    }

    public function getReligion(): ?string
    {
        return $this->religion;
    }

    public function setReligion(?string $religion): self
    {
        $this->religion = $religion;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }




    public function getEtsouservice(): ?EtsouService
    {
        return $this->etsouservice;
    }

    public function setEtsouservice(?EtsouService $etsouservice): self
    {
        $this->etsouservice = $etsouservice;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }


    /**
     * @return Collection|AffectationSuccessive[]
     */
    public function getAffectationSuccessive(): Collection
    {
        return $this->affectationSuccessives;
    }

    public function addAffectationSuccessive(AffectationSuccessive $affectationSuccessive): self
    {
        if (!$this->affectationSuccessives->contains($affectationSuccessive)) {
            $this->affectationSuccessives[] = $affectationSuccessive;
            $affectationSuccessive->setPersonnel($this);
        }

        return $this;
    }

    public function removeAffectationSuccessive(AffectationSuccessive $affectationSuccessive): self
    {
        if ($this->affectationSuccessives->contains($affectationSuccessive)) {
            $this->affectationSuccessives->removeElement($affectationSuccessive);
            // set the owning side to null (unless already changed)
            if ($affectationSuccessive->getPersonnel() === $this) {
                $affectationSuccessive->setPersonnel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Avancement[]
     */
    public function getAvancement(): Collection
    {
        return $this->avancements;
    }

    public function addAvancement(Avancement $avancement): self
    {
        if (!$this->avancements->contains($avancement)) {
            $this->avancements[] = $avancement;
            $avancement->setPersonnel($this);
        }

        return $this;
    }

    public function removeAvancement(Avancement $avancement): self
    {
        if ($this->avancements->contains($avancement)) {
            $this->avancements->removeElement($avancement);
            // set the owning side to null (unless already changed)
            if ($avancement->getPersonnel() === $this) {
                $avancement->setPersonnel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Decoration[]
     */
    public function getDecoration(): Collection
    {
        return $this->decoration;
    }

    public function addDecoration(Decoration $decoration): self
    {
        if (!$this->decoration->contains($decoration)) {
            $this->decoration[] = $decoration;
            $decoration->setPersonnel($this);
        }

        return $this;
    }

    public function removeDecoration(Decoration $decoration): self
    {
        if ($this->decoration->contains($decoration)) {
            $this->decoration->removeElement($decoration);
            // set the owning side to null (unless already changed)
            if ($decoration->getPersonnel() === $this) {
                $decoration->setPersonnel(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|Enfant[]
     */
    public function getEnfant(): Collection
    {
        return $this->enfants;
    }

    public function addEnfant(Enfant $enfant): self
    {
        if (!$this->enfants->contains($enfant)) {
            $this->enfants[] = $enfant;
            $enfant->setPersonnel($this);
        }

        return $this;
    }

    public function removeEnfant(Enfant $enfant): self
    {
        if ($this->enfants->contains($enfant)) {
            $this->enfants->removeElement($enfant);
            // set the owning side to null (unless already changed)
            if ($enfant->getPersonnel() === $this) {
                $enfant->setPersonnel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ecole[]
     */
    public function getEcole(): Collection
    {
        return $this->ecoles;
    }

    public function addEcole(Ecole $ecole): self
    {
        if (!$this->ecoles->contains($ecole)) {
            $this->ecoles[] = $ecole;
            $ecole->setPersonnel($this);
        }

        return $this;
    }

    public function removeEcole(Ecole $ecole): self
    {
        if ($this->ecoles->contains($ecole)) {
            $this->ecoles->removeElement($ecole);
            // set the owning side to null (unless already changed)
            if ($ecole->getPersonnel() === $this) {
                $ecole->setPersonnel(null);
            }
        }

        return $this;
    }

    public function getUpdated_at(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdated_at(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param null|File $imageFile
     * @return Personnel
     */
    public function setImageFile(?File $imageFile): Personnel
    {
        $this->imageFile = $imageFile;
        // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getRupture(): ?string
    {
        return $this->rupture;
    }

    public function setRupture(string $rupture): self
    {
        $this->rupture = $rupture;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }


    public function getDetachement(): ?Detachement
    {
        return $this->detachement;
    }

    public function setDetachement(?Detachement $detachement): self
    {
        $this->detachement = $detachement;

        return $this;
    }


    public function getDatenaisse(): ?\DateTime
    {
        return $this->datenaisse;
    }

    public function setDatenaisse(\DateTime $datenaisse): self
    {
        $this->datenaisse = $datenaisse;

        return $this;
    }

    public function getDateRetraite(): ?\DateTime
    {
        return $this->dateRetraite;
    }

    public function setDateRetraite(\DateTime $dateRetraite): self
    {
        $this->dateRetraite = $dateRetraite;

        return $this;
    }

    public function getDirection(): ?Direction
    {
        return $this->direction;
    }

    public function setDirection(?Direction $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return Collection|Search[]
     */
    public function getSearches(): Collection
    {
        return $this->searches;
    }

    public function addSearch(Search $search): self
    {
        if (!$this->searches->contains($search)) {
            $this->searches[] = $search;
            $search->addPersonnel($this);
        }

        return $this;
    }

    public function removeSearch(Search $search): self
    {
        if ($this->searches->contains($search)) {
            $this->searches->removeElement($search);
            $search->removePersonnel($this);
        }

        return $this;
    }

    public function getAffectionactuelle(): ?string
    {
        return $this->affectionactuelle;
    }

    public function setAffectionactuelle(string $affectionactuelle): self
    {
        $this->affectionactuelle = $affectionactuelle;

        return $this;
    }

    public function getMatricule(): ?int
    {
        return $this->matricule;
    }

    public function setMatricule(?int $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getDaterecrute(): ?\DateTimeInterface
    {
        return $this->daterecrute;
    }

    public function setDaterecrute(\DateTimeInterface $daterecrute): self
    {
        $this->daterecrute = $daterecrute;

        return $this;
    }

    public function getIndice(): ?string
    {
        return $this->indice;
    }

    public function setIndice(string $indice): self
    {
        $this->indice = $indice;

        return $this;
    }

    public function getInterruptiondu(): ?\DateTimeInterface
    {
        return $this->interruptiondu;
    }

    public function setInterruptiondu(?\DateTimeInterface $interruptiondu): self
    {
        $this->interruptiondu = $interruptiondu;

        return $this;
    }

    public function getAu(): ?\DateTimeInterface
    {
        return $this->au;
    }

    public function setAu(?\DateTimeInterface $au): self
    {
        $this->au = $au;

        return $this;
    }

    public function getSortantecole(): ?string
    {
        return $this->sortantecole;
    }

    public function setSortantecole(?string $sortantecole): self
    {
        $this->sortantecole = $sortantecole;

        return $this;
    }

    public function getNomconjoint(): ?string
    {
        return $this->nomconjoint;
    }

    public function setNomconjoint(?string $nomconjoint): self
    {
        $this->nomconjoint = $nomconjoint;

        return $this;
    }

    public function getDatemariage(): ?\DateTimeInterface
    {
        return $this->datemariage;
    }

    public function setDatemariage(?\DateTimeInterface $datemariage): self
    {
        $this->datemariage = $datemariage;

        return $this;
    }

    public function getDateNaissConj(): ?\DateTimeInterface
    {
        return $this->dateNaissConj;
    }

    public function setDateNaissConj(?\DateTimeInterface $dateNaissConj): self
    {
        $this->dateNaissConj = $dateNaissConj;

        return $this;
    }

    public function getLieuNaissConj(): ?string
    {
        return $this->lieuNaissConj;
    }

    public function setLieuNaissConj(?string $lieuNaissConj): self
    {
        $this->lieuNaissConj = $lieuNaissConj;

        return $this;
    }

    public function getBureautique(): ?bool
    {
        return $this->bureautique;
    }

    public function setBureautique(?bool $bureautique): self
    {
        $this->bureautique = $bureautique;

        return $this;
    }

    public function getAutres(): ?string
    {
        return $this->autres;
    }

    public function setAutres(?string $autres): self
    {
        $this->autres = $autres;

        return $this;
    }

    public function getFrancais(): ?string
    {
        return $this->francais;
    }

    public function setFrancais(string $francais): self
    {
        $this->francais = $francais;

        return $this;
    }

    public function getAnglais(): ?string
    {
        return $this->anglais;
    }

    public function setAnglais(string $anglais): self
    {
        $this->anglais = $anglais;

        return $this;
    }

    public function getAutresLangue(): ?string
    {
        return $this->autresLangue;
    }

    public function setAutresLangue(?string $autresLangue): self
    {
        $this->autresLangue = $autresLangue;

        return $this;
    }

    public function getNumPermis(): ?string
    {
        return $this->NumPermis;
    }

    public function setNumPermis(?string $NumPermis): self
    {
        $this->NumPermis = $NumPermis;

        return $this;
    }

    public function getPermisDelivrele(): ?\DateTime
    {
        return $this->permisDelivrele;
    }

    public function setPermisDelivrele(?\DateTime $permisDelivrele): self
    {
        $this->permisDelivrele = $permisDelivrele;

        return $this;
    }

    public function getLieuDelivrance(): ?string
    {
        return $this->lieuDelivrance;
    }

    public function setLieuDelivrance(?string $lieuDelivrance): self
    {
        $this->lieuDelivrance = $lieuDelivrance;

        return $this;
    }

    public function getPermisCategorie(): ?string
    {
        return $this->permisCategorie;
    }

    public function setPermisCategorie(?string $permisCategorie): self
    {
        $this->permisCategorie = $permisCategorie;

        return $this;
    }

    public function getAutresPermis(): ?string
    {
        return $this->autresPermis;
    }

    public function setAutresPermis(?string $autresPermis): self
    {
        $this->autresPermis = $autresPermis;

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
            $autoAbsence->setPersonnel($this);
        }

        return $this;
    }

    public function removeAutoAbsence(AutoAbsence $autoAbsence): self
    {
        if ($this->autoAbsences->contains($autoAbsence)) {
            $this->autoAbsences->removeElement($autoAbsence);
            // set the owning side to null (unless already changed)
            if ($autoAbsence->getPersonnel() === $this) {
                $autoAbsence->setPersonnel(null);
            }
        }

        return $this;
    }


}
