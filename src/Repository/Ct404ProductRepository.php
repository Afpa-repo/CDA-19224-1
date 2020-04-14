<?php

namespace App\Repository;

use App\Entity\Ct404Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ct404Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ct404Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ct404Product[]    findAll()
 * @method Ct404Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Ct404ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ct404Product::class);
    }

    public function findByCategory($category)
    {
        return $this->createQueryBuilder('p')
            ->join('p.sub_category', 's')
            ->join('s.category', 'c')
            ->andWhere('c.id = :val')
            ->setParameter('val', $category)
            ->getQuery()
            ->getResult()
            ;
    }

    public function searchInRow($search, $row)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.'.$row.' LIKE :search')
            ->setParameter('search', '%'.$search.'%')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Ct404Product[] Returns an array of Ct404Product objects
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
    public function findOneBySomeField($value): ?Ct404Product
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
