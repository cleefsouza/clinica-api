<?php

namespace App\Controller;

use App\Entity\Medico;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MedicoRepository;
use App\Service\MedicoService;
use Symfony\Component\HttpFoundation\{
    JsonResponse,
    Request
};

/**
 * Class MedicoController
 * @package App\Controller
 */
class MedicoController extends AbstractEntityController
{

    /**
     * MedicoController constructor.
     * @param EntityManagerInterface $entityManager
     * @param MedicoService $medicoService
     * @param MedicoRepository $medicoRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        MedicoService $medicoService,
        MedicoRepository $medicoRepository
    ) {
        parent::__construct($medicoRepository, $entityManager, $medicoService);
    }

    /**
     * @param Medico $entity
     * @param Medico $newEntity
     * @return mixed
     */
    public function updateEntity($entity, $newEntity)
    {
        $entity->setCrm($newEntity->getCrm())->setNome($newEntity->getNome())->setEspecialidade(
            $newEntity->getEspecialidade()
        );
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @Route("/medico/especialidade/{id}", methods={"GET"})
     */
    public function getMedicosPorEspecialidade(int $id): JsonResponse
    {
        $medicos = $this->repository->findBy(["especialidade" => $id]);

        if (empty($medicos)) {
            return new JsonResponse("", JsonResponse::HTTP_NO_CONTENT);
        }

        return new JsonResponse($medicos);
    }
}
