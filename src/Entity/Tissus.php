<?php

namespace App\Entity;

use App\Repository\TissusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TissusRepository::class)]
class Tissus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[ORM\Column(length: 50)]
    private ?string $qualité = null;

    #[ORM\Column]
    private ?int $taille = null;

    #[ORM\ManyToOne(inversedBy: 'Tissus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $produits = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getQualité(): ?string
    {
        return $this->qualité;
    }

    public function setQualité(string $qualité): static
    {
        $this->qualité = $qualité;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getProduits(): ?Produits
    {
        return $this->produits;
    }

    public function setProduits(?Produits $produits): static
    {
        $this->produits = $produits;

        return $this;
    }
}
