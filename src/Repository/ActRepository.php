<?php

namespace App\Repository;

use App\Entity\Act;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Act|null find($id, $lockMode = null, $lockVersion = null)
 * @method Act|null findOneBy(array $criteria, array $orderBy = null)
 * @method Act[]    findAll()
 * @method Act[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Act::class);
    }

    public function findActsByDentistId($id)
    {
        $qb = $this->createQueryBuilder('a');

        $qb->select('a')
            ->innerJoin('a.horse', 'h', 'WITH', 'a.horse = h.id')
            ->innerJoin('h.owner', 'o', 'WITH', 'h.owner = o.id')
            ->where('o.dentist = :id')
            ->setParameter('id', $id);

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}

/*
$qb->select('h')
    ->innerJoin('h.owner', 'c', 'WITH', 'h.owner = c.id')
    ->where('c.dentist = :id')
    ->setParameter('id', $id);
*/
