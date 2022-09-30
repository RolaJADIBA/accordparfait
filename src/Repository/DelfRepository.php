<?php

namespace App\Repository;

use App\Entity\Delf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Delf|null find($id, $lockMode = null, $lockVersion = null)
 * @method Delf|null findOneBy(array $criteria, array $orderBy = null)
 * @method Delf[]    findAll()
 * @method Delf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DelfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Delf::class);
    }

    // /**
    //  * @return Delf[] Returns an array of Delf objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Delf
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
