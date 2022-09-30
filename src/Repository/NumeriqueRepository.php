<?php

namespace App\Repository;

use App\Entity\Numerique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Numerique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Numerique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Numerique[]    findAll()
 * @method Numerique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NumeriqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Numerique::class);
    }

    // /**
    //  * @return Numerique[] Returns an array of Numerique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Numerique
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
