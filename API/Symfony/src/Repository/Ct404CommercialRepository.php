<?php

namespace App\Repository;

use App\Entity\Ct404Commercial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ct404Commercial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ct404Commercial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ct404Commercial[]    findAll()
 * @method Ct404Commercial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Ct404CommercialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ct404Commercial::class);
    }

    // /**
    //  * @return Ct404Commercial[] Returns an array of Ct404Commercial objects
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
    public function findOneBySomeField($value): ?Ct404Commercial
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
