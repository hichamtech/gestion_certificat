<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModuleRepository::class)
 */
class Module
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity=Filiere::class, inversedBy="modules")
     */
    private $filiere;

    /**
     * @ORM\OneToMany(targetEntity=SousModule::class, mappedBy="module")
     */
    private $sousModules;

    public function __construct()
    {
        $this->sousModules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|SousModule[]
     */
    public function getSousModules(): Collection
    {
        return $this->sousModules;
    }

    public function addSousModule(SousModule $sousModule): self
    {
        if (!$this->sousModules->contains($sousModule)) {
            $this->sousModules[] = $sousModule;
            $sousModule->setModule($this);
        }

        return $this;
    }

    public function removeSousModule(SousModule $sousModule): self
    {
        if ($this->sousModules->removeElement($sousModule)) {
            // set the owning side to null (unless already changed)
            if ($sousModule->getModule() === $this) {
                $sousModule->setModule(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;
    }
}
