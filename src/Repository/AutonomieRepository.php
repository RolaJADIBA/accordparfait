<?php

namespace App\Repository;

use App\Entity\Autonomie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Autonomie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Autonomie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Autonomie[]    findAll()
 * @method Autonomie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AutonomieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Autonomie::class);
    }

    // /**
    //  * @return Autonomie[] Returns an array of Autonomie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Autonomie
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
