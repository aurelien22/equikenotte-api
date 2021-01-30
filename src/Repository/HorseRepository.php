<?php

namespace App\Repository;

use App\Entity\Horse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Horse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Horse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Horse[]    findAll()
 * @method Horse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Horse::class);
    }

    public function findHorsesByDentistId($id)
    {
        $qb = $this->createQueryBuilder('h');

        $qb->select('h')
            ->innerJoin('h.owner', 'c', 'WITH', 'h.owner = c.id')
            ->where('c.dentist = :id')
            ->setParameter('id', $id);

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

}
