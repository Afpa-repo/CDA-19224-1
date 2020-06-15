<?php

namespace App\Repository;

use App\Entity\Ct404Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ct404Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ct404Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ct404Category[]    findAll()
 * @method Ct404Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Ct404CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ct404Category::class);
    }

    // /**
    //  * @return Ct404Category[] Returns an array of Ct404Category objects
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
    public function findOneBySomeField($value): ?Ct404Category
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
