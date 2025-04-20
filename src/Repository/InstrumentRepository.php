<?php

namespace App\Repository;

use App\Entity\Instrument;
use App\Data\InstrumentSearchData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Instrument>
 */
class InstrumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Instrument::class);
    }

    //    /**
    //     * @return Instrument[] Returns an array of Instrument objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Instrument
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function findSearch(InstrumentSearchData $data)
    {
        $qb = $this->createQueryBuilder('i');
    
        if ($data->q) {
            $qb->andWhere('i.name_instr LIKE :q OR i.manufacturer LIKE :q')
               ->setParameter('q', '%' . $data->q . '%');
        }
        if ($data->type_instr) {
            $qb->andWhere('i.type_instr = :type')
               ->setParameter('type', $data->type_instr);
        }
        if ($data->year_min) {
            $qb->andWhere('i.year_instr >= :year_min')
               ->setParameter('year_min', $data->year_min);
        }
        if ($data->year_max) {
            $qb->andWhere('i.year_instr <= :year_max')
               ->setParameter('year_max', $data->year_max);
        }
        if ($data->polyphony) {
            $qb->andWhere('i.polyphony LIKE :poly')
               ->setParameter('poly', '%' . $data->polyphony . '%');
        }
    
        return $qb->getQuery()->getResult();
    }

}
