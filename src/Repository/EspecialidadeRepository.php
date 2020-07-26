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
}
