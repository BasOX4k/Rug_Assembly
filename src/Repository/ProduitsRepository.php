<?php

namespace App\Repository;

use App\Entity\Produits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProduitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produits::class);
    }

    /**
     * Recherche les produits par nom.
     *
     * @param string $name
     * @return Produits[]
     */
    public function findByName(string $name): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.nom LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->getQuery()
            ->getResult();
    }
}
