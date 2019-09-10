<?php

namespace App\Repository;

use App\Entity\RandomNumber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RandomNumber|null find($id, $lockMode = null, $lockVersion = null)
 * @method RandomNumber|null findOneBy(array $criteria, array $orderBy = null)
 * @method RandomNumber[]    findAll()
 * @method RandomNumber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RandomNumberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RandomNumber::class);
    }

}
