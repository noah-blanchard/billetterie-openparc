<?php

namespace App\Repository;

use App\Entity\ReservPlace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReservPlace|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservPlace|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservPlace[]    findAll()
 * @method ReservPlace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservPlaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservPlace::class);
    }

    // /**
    //  * @return ReservPlace[] Returns an array of ReservPlace objects
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
    public function findOneBySomeField($value): ?ReservPlace
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
