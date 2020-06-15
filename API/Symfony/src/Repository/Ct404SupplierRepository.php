<?php

namespace App\Repository;

use App\Entity\Ct404Supplier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ct404Supplier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ct404Supplier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ct404Supplier[]    findAll()
 * @method Ct404Supplier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Ct404SupplierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ct404Supplier::class);
    }

    // /**
    //  * @return Ct404Supplier[] Returns an array of Ct404Supplier objects
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
    public function findOneBySomeField($value): ?Ct404Supplier
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
