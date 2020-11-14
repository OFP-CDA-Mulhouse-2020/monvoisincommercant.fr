<?php

namespace App\Repository;

use App\Entity\Localized;
use App\Entity\Merchant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Merchant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Merchant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Merchant[]    findAll()
 * @method Merchant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MerchantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Merchant::class);
    }

    public function findAllNearestFrom(float $latitude, float $longitude, $limit=20)
    {
        $sql = "select
                    m.*,                    
                    round(st_distance_sphere(m.coords, st_geomfromtext('Point({$latitude} {$longitude})'))/1000,2) as distance
                from merchant m
                order by distance asc
                LIMIT {$limit} ;
                ";

        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata(Merchant::class, 'm');
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);

        return $query->getResult();
    }


}
