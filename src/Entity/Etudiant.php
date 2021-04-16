<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $codeApogee;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $cne;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $cin;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $villeNaissance;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $paysNaissance;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $anneePremiereInscription;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $anneePremiereInscriptionSup;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $anneePremiereInscriptionUniMaro;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $codeBac;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $serieBac;

    /**
     * @ORM\ManyToOne(targetEntity=Filiere::class, inversedBy="etudiants")
     * @ORM\JoinColumn(nullable=true)
     */
    private $filiere;




    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="etudiant")
     */
    private $inscriptions;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="etudiant", cascade={"persist", "remove"})
     */
    private $user;

   

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeApogee(): ?string
    {
        return $this->codeApogee;
    }

    public function setCodeApogee(string $codeApogee): self
    {
        $this->codeApogee = $codeApogee;

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

    public function getCne(): ?string
    {
        return $this->cne;
    }

    public function setCne(string $cne): self
    {
        $this->cne = $cne;

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

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getVilleNaissance(): ?string
    {
        return $this->villeNaissance;
    }

    public function setVilleNaissance(string $villeNaissance): self
    {
        $this->villeNaissance = $villeNaissance;

        return $this;
    }

    public function getPaysNaissance(): ?string
    {
        return $this->paysNaissance;
    }

    public function setPaysNaissance(string $paysNaissance): self
    {
        $this->paysNaissance = $paysNaissance;

        return $this;
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getAnneePremiereInscription(): ?string
    {
        return $this->anneePremiereInscription;
    }

    public function setAnneePremiereInscription(string $anneePremiereInscription): self
    {
        $this->anneePremiereInscription = $anneePremiereInscription;

        return $this;
    }

    public function getAnneePremiereInscriptionSup(): ?string
    {
        return $this->anneePremiereInscriptionSup;
    }

    public function setAnneePremiereInscriptionSup(string $anneePremiereInscriptionSup): self
    {
        $this->anneePremiereInscriptionSup = $anneePremiereInscriptionSup;

        return $this;
    }

    public function getAnneePremiereInscriptionUniMaro(): ?string
    {
        return $this->anneePremiereInscriptionUniMaro;
    }

    public function setAnneePremiereInscriptionUniMaro(string $anneePremiereInscriptionUniMaro): self
    {
        $this->anneePremiereInscriptionUniMaro = $anneePremiereInscriptionUniMaro;

        return $this;
    }

    public function getCodeBac(): ?string
    {
        return $this->codeBac;
    }

    public function setCodeBac(string $codeBac): self
    {
        $this->codeBac = $codeBac;

        return $this;
    }

    public function getSerieBac(): ?string
    {
        return $this->serieBac;
    }

    public function setSerieBac(string $serieBac): self
    {
        $this->serieBac = $serieBac;

        return $this;
    }

    public function getFiliere(): ?Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(?Filiere $filiere): self
    {
        $this->filiere = $filiere;

        return $this;
    }



    /**
     * @return Collection|Inscription[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setEtudiant($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getEtudiant() === $this) {
                $inscription->setEtudiant(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom." ".$this->prenom;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setEtudiant(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getEtudiant() !== $this) {
            $user->setEtudiant($this);
        }

        $this->user = $user;

        return $this;
    }

    


}
