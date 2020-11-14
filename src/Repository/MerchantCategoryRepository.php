<?php

namespace App\Repository;

use App\Entity\MerchantCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MerchantCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method MerchantCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method MerchantCategory[]    findAll()
 * @method MerchantCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MerchantCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MerchantCategory::class);
    }

    // /**
    //  * @return MerchantCategory[] Returns an array of MerchantCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MerchantCategory
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
