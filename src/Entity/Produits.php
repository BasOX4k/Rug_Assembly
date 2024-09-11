<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nom = null;

    #[ORM\Column(length: 250)]
    private ?string $description = null;

    #[ORM\Column(length: 380)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $prix = null;

    /**
     * @var Collection<int, Tissus>
     */
    #[ORM\OneToMany(targetEntity: Tissus::class, mappedBy: 'produits')]
    private Collection $Tissus;

    /**
     * @var Collection<int, Pistolets>
     */
    #[ORM\OneToMany(targetEntity: Pistolets::class, mappedBy: 'produits')]
    private Collection $Pistolets;

    /**
     * @var Collection<int, Tapis>
     */
    #[ORM\OneToMany(targetEntity: Tapis::class, mappedBy: 'produits')]
    private Collection $Tapis;

    /**
     * @var Collection<int, Tondeuses>
     */
    #[ORM\OneToMany(targetEntity: Tondeuses::class, mappedBy: 'produits')]
    private Collection $Tondeuses;

    /**
     * @var Collection<int, Accessoires>
     */
    #[ORM\OneToMany(targetEntity: Accessoires::class, mappedBy: 'produits')]
    private Collection $Accessoires;

    public function __construct()
    {
        $this->Tissus = new ArrayCollection();
        $this->Pistolets = new ArrayCollection();
        $this->Tapis = new ArrayCollection();
        $this->Tondeuses = new ArrayCollection();
        $this->Accessoires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Tissus>
     */
    public function getTissus(): Collection
    {
        return $this->Tissus;
    }

    public function addTissu(Tissus $tissu): static
    {
        if (!$this->Tissus->contains($tissu)) {
            $this->Tissus->add($tissu);
            $tissu->setProduits($this);
        }

        return $this;
    }

    public function removeTissu(Tissus $tissu): static
    {
        if ($this->Tissus->removeElement($tissu)) {
            // set the owning side to null (unless already changed)
            if ($tissu->getProduits() === $this) {
                $tissu->setProduits(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Pistolets>
     */
    public function getPistolets(): Collection
    {
        return $this->Pistolets;
    }

    public function addPistolet(Pistolets $pistolet): static
    {
        if (!$this->Pistolets->contains($pistolet)) {
            $this->Pistolets->add($pistolet);
            $pistolet->setProduits($this);
        }

        return $this;
    }

    public function removePistolet(Pistolets $pistolet): static
    {
        if ($this->Pistolets->removeElement($pistolet)) {
            // set the owning side to null (unless already changed)
            if ($pistolet->getProduits() === $this) {
                $pistolet->setProduits(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tapis>
     */
    public function getTapis(): Collection
    {
        return $this->Tapis;
    }

    public function addTapi(Tapis $tapi): static
    {
        if (!$this->Tapis->contains($tapi)) {
            $this->Tapis->add($tapi);
            $tapi->setProduits($this);
        }

        return $this;
    }

    public function removeTapi(Tapis $tapi): static
    {
        if ($this->Tapis->removeElement($tapi)) {
            // set the owning side to null (unless already changed)
            if ($tapi->getProduits() === $this) {
                $tapi->setProduits(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tondeuses>
     */
    public function getTondeuses(): Collection
    {
        return $this->Tondeuses;
    }

    public function addTondeus(Tondeuses $tondeus): static
    {
        if (!$this->Tondeuses->contains($tondeus)) {
            $this->Tondeuses->add($tondeus);
            $tondeus->setProduits($this);
        }

        return $this;
    }

    public function removeTondeus(Tondeuses $tondeus): static
    {
        if ($this->Tondeuses->removeElement($tondeus)) {
            // set the owning side to null (unless already changed)
            if ($tondeus->getProduits() === $this) {
                $tondeus->setProduits(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Accessoires>
     */
    public function getAccessoires(): Collection
    {
        return $this->Accessoires;
    }

    public function addAccessoire(Accessoires $accessoire): static
    {
        if (!$this->Accessoires->contains($accessoire)) {
            $this->Accessoires->add($accessoire);
            $accessoire->setProduits($this);
        }

        return $this;
    }

    public function removeAccessoire(Accessoires $accessoire): static
    {
        if ($this->Accessoires->removeElement($accessoire)) {
            // set the owning side to null (unless already changed)
            if ($accessoire->getProduits() === $this) {
                $accessoire->setProduits(null);
            }
        }

        return $this;
    }
}
