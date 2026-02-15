<?php

namespace App\Repository;

use App\Entity\Camiseta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Camiseta>
 */
class CamisetaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Camiseta::class);
    }
    public function findByText(string $searchTerm): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere("p.equipo LIKE :val")
            ->setParameter('val', $searchTerm . '%')
            ->orderBy('p.equipo', 'DESC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Camiseta[] Returns an array of Camiseta objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Camiseta
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
