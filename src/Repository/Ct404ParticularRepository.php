<?php

namespace App\Repository;

use App\Entity\Ct404Particular;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ct404Particular|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ct404Particular|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ct404Particular[]    findAll()
 * @method Ct404Particular[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Ct404ParticularRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ct404Particular::class);
    }

    // /**
    //  * @return Ct404Particular[] Returns an array of Ct404Particular objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ct404Particular
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
