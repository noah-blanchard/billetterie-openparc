<?php

namespace App\Repository;

use App\Entity\Ramasseur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ramasseur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ramasseur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ramasseur[]    findAll()
 * @method Ramasseur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RamasseurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ramasseur::class);
    }

    // /**
    //  * @return Ramasseur[] Returns an array of Ramasseur objects
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
    public function findOneBySomeField($value): ?Ramasseur
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
