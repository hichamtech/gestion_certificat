<?php

namespace App\Entity;

use App\Repository\TypeDemandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeDemandeRepository::class)
 */
class TypeDemande
{
    const TYPE_SCOLARITE = 'Certificat de scolarité';
    const TYPE_RELEVE = 'Relevé des notes';
    const TYPE_STAGE = 'Demande de stage';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $libele;

    /**
     * @ORM\OneToMany(targetEntity=Demande::class, mappedBy="type")
     */
    private $demandes;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreMax;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibele(): ?string
    {
        return $this->libele;
    }

    public function setLibele(string $libele): self
    {
        $this->libele = $libele;

        return $this;
    }

    /**
     * @return Collection|Demande[]
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): self
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes[] = $demande;
            $demande->setType($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getType() === $this) {
                $demande->setType(null);
            }
        }

        return $this;
    }

    public function getNombreMax(): ?int
    {
        return $this->nombreMax;
    }

    public function setNombreMax(int $nombreMax): self
    {
        $this->nombreMax = $nombreMax;

        return $this;
    }

    public function __toString()
    {
        return $this->libele;
    }


}
