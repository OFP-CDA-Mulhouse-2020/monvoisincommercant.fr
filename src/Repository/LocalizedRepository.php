<?php

namespace App\Repository;

use App\Entity\Localized;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\Persistence\ManagerRegistry;

use const LDAP_OPT_X_TLS_CRL_ALL;

/**
 * @method Localized|null find($id, $lockMode = null, $lockVersion = null)
 * @method Localized|null findOneBy(array $criteria, array $orderBy = null)
 * @method Localized[]    findAll()
 * @method Localized[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocalizedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Localized::class);
    }



    // /**
    //  * @return Localized[] Returns an array of Localized objects
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
    public function findOneBySomeField($value): ?Localized
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findNearestFrom(float $latitude, float $longitude, $limit=20)
    {
        $sql = "select
                    l.id, 
                    l.label, 
                    l.coords,
                    round(st_distance_sphere(coords, st_geomfromtext('Point({$latitude} {$longitude})'))/1000,2) as distance
                from localized l
                order by distance asc
                LIMIT {$limit} ;
                ";

        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata(Localized::class, 'l');
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);

        return $query->getResult();
    }
}
