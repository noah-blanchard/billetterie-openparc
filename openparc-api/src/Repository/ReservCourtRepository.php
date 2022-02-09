<?php

namespace App\Repository;

use App\Entity\ReservCourt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReservCourt|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservCourt|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservCourt[]    findAll()
 * @method ReservCourt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservCourtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservCourt::class);
    }

    // /**
    //  * @return ReservCourt[] Returns an array of ReservCourt objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReservCourt
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
