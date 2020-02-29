<?php

namespace App\Repository;

use App\Entity\LignePrescriptive;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LignePrescriptive|null find($id, $lockMode = null, $lockVersion = null)
 * @method LignePrescriptive|null findOneBy(array $criteria, array $orderBy = null)
 * @method LignePrescriptive[]    findAll()
 * @method LignePrescriptive[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LignePrescriptiveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LignePrescriptive::class);
    }

    // /**
    //  * @return LignePrescriptive[] Returns an array of LignePrescriptive objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LignePrescriptive
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
