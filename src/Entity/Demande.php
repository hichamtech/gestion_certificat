<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DemandeRepository::class)
 */
class Demande
{
    const STATUT_IN_PROGRESS = 'En Cours';
    const STATUT_IN_PREPARATION = 'En preparation';
    const STATUT_VALIDE= 'Valider';
    const STATUT_COMPLETED = 'Terminer';
    const STATUT_REFUSE = 'Refuser';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="demande")
     */
    private $etudiant;

    /**
     * @ORM\ManyToOne(targetEntity=TypeDemande::class, inversedBy="demandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="demande")
     */
    private $messages;

  

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $statut;

    public function __construct()
    {
        $this->etudiant = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiant(): Collection
    {
        return $this->etudiant;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiant->contains($etudiant)) {
            $this->etudiant[] = $etudiant;
            $etudiant->setDemande($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiant->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getDemande() === $this) {
                $etudiant->setDemande(null);
            }
        }

        return $this;
    }

    public function getType(): ?TypeDemande
    {
        return $this->type;
    }

    public function setType(?TypeDemande $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setDemande($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getDemande() === $this) {
                $message->setDemande(null);
            }
        }

        return $this;
    }

  

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }
}
