<?php

namespace App\Repository;

use App\Entity\Ct404Professional;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ct404Professional|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ct404Professional|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ct404Professional[]    findAll()
 * @method Ct404Professional[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Ct404ProfessionalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ct404Professional::class);
    }

    // /**
    //  * @return Ct404Professional[] Returns an array of Ct404Professional objects
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
    public function findOneBySomeField($value): ?Ct404Professional
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
