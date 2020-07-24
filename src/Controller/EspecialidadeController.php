<?php

namespace App\Controller;

use App\Repository\EspecialidadeRepository;
use App\Utils\FiltroRequest;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\EspecialidadeService;
use App\Entity\Especialidade;

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
     * @param FiltroRequest $filtroRequest
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        EspecialidadeRepository $especialidadeRepository,
        EspecialidadeService $especialidadeService,
        FiltroRequest $filtroRequest
    ) {
        parent::__construct($especialidadeRepository, $entityManager, $especialidadeService, $filtroRequest);
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
