<?php

namespace App\Controller;

use App\Entity\Especialidade;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EspecialidadeRepository;
use App\Service\EspecialidadeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\{
    JsonResponse,
    Request
};

/**
 * Class EspecialidadeController
 * @package App\Controller
 */
class EspecialidadeController extends AbstractEntityController
{

    /**
     * EspecialidadeController constructor.
     * @param EntityManagerInterface $entityManager
     * @param EspecialidadeRepository $especialidadeRepository
     * @param EspecialidadeService $especialidadeService
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        EspecialidadeRepository $especialidadeRepository,
        EspecialidadeService $especialidadeService
    ) {
        parent::__construct($especialidadeRepository, $entityManager, $especialidadeService);
    }

    /**
     * @param Especialidade $entity
     * @param Especialidade $newEntity
     * @return mixed
     */
    public function updateEntity($entity, $newEntity)
    {
        $entity->setDescricao($newEntity->getDescricao());
    }
}
