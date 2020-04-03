<?php

namespace App\Repository;

use App\Entity\Ct404OrderDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ct404OrderDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ct404OrderDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ct404OrderDetail[]    findAll()
 * @method Ct404OrderDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Ct404OrderDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ct404OrderDetail::class);
    }

    // /**
    //  * @return Ct404OrderDetail[] Returns an array of Ct404OrderDetail objects
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
    public function findOneBySomeField($value): ?Ct404OrderDetail
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
