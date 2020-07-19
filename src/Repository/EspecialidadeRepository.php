<?php

namespace App\Repository;

use App\Entity\Especialidade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Especialidade|null find($id, $lockMode = null, $lockVersion = null)
 * @method Especialidade|null findOneBy(array $criteria, array $orderBy = null)
 * @method Especialidade[]    findAll()
 * @method Especialidade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspecialidadeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Especialidade::class);
    }

    // /**
    //  * @return Especialidade[] Returns an array of Especialidade objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Especialidade
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
