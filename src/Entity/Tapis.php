<?php

namespace App\Entity;

use App\Repository\TapisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TapisRepository::class)]
class Tapis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'Tapis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $produits = null;

    public function getId(): ?int
    {
        return $this->id;
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
