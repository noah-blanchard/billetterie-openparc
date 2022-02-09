<?php

namespace App\Repository;

use App\Entity\Ok;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ok|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ok|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ok[]    findAll()
 * @method Ok[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ok::class);
    }

    // /**
    //  * @return Ok[] Returns an array of Ok objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ok
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
