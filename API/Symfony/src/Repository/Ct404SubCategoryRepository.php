<?php

namespace App\Repository;

use App\Entity\Ct404SubCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ct404SubCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ct404SubCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ct404SubCategory[]    findAll()
 * @method Ct404SubCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Ct404SubCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ct404SubCategory::class);
    }

    // /**
    //  * @return Ct404SubCategory[] Returns an array of Ct404SubCategory objects
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
    public function findOneBySomeField($value): ?Ct404SubCategory
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
