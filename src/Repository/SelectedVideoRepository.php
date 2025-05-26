<?php

namespace App\Repository;

use App\Entity\SelectedVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class SelectedVideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SelectedVideo::class);
    }


public function findByCategory($category, $limit = 10)
{
    return $this->createQueryBuilder('v')
        ->where('v.category = :cat')
        ->setParameter('cat', $category)
        ->setMaxResults($limit)
        ->getQuery()
        ->getResult();
}

}
