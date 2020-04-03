<?php

namespace App\Repository;

use App\Entity\Ct404Ordered;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ct404Ordered|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ct404Ordered|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ct404Ordered[]    findAll()
 * @method Ct404Ordered[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Ct404OrderedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ct404Ordered::class);
    }

    // /**
    //  * @return Ct404Ordered[] Returns an array of Ct404Ordered objects
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
    public function findOneBySomeField($value): ?Ct404Ordered
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
