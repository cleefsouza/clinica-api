<?php

namespace App\Controller;

use App\Entity\Especialidade;
use App\Repository\EspecialidadeRepository;
use App\Service\EspecialidadeFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EspecialidadeController
 * @package App\Controller
 */
class EspecialidadeController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;
    /**
     * @var EspecialidadeRepository
     */
    private EspecialidadeRepository $especialidadeRepository;
    /**
     * @var EspecialidadeFactory
     */
    private EspecialidadeFactory $especialidadeFactory;

    /**
     * EspecialidadeController constructor.
     * @param EntityManagerInterface $entityManager
     * @param EspecialidadeRepository $especialidadeRepository
     * @param EspecialidadeFactory $especialidadeFactory
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        EspecialidadeRepository $especialidadeRepository,
        EspecialidadeFactory $especialidadeFactory
    ) {
        $this->entityManager = $entityManager;
        $this->especialidadeRepository = $especialidadeRepository;
        $this->especialidadeFactory = $especialidadeFactory;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/especialidade", methods={"POST"})
     */
    public function create(Request $request): JsonResponse
    {
        $body = $request->getContent();
        $especialidade = $this->especialidadeFactory->criarEspecialidade($body);

        $this->entityManager->persist($especialidade);
        $this->entityManager->flush();

        return new JsonResponse($especialidade->jsonSerialize());
    }

    /**
     * @return JsonResponse
     *
     * @Route("/especialidade", methods={"GET"})
     */
    public function readAll(): JsonResponse
    {
        $especialidades = $this->especialidadeRepository->findAll();

        return new JsonResponse($especialidades);
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @Route("/especialidade/{id}", methods={"GET"})
     */
    public function read(int $id): JsonResponse
    {
        $especialidade = $this->especialidadeRepository->find($id);

        if (is_null($especialidade)) {
            return new JsonResponse("", JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse($especialidade->jsonSerialize());
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/especialidade/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request): JsonResponse
    {
        $body = $request->getContent();
        $novaEspecialidade = $this->especialidadeFactory->criarEspecialidade($body);

        $especialidade = $this->especialidadeRepository->find($id);

        if (is_null($especialidade)) {
            return new JsonResponse("", JsonResponse::HTTP_NOT_FOUND);
        }

        $especialidade->setDescricao($novaEspecialidade->getDescricao());

        $this->entityManager->flush();

        return new JsonResponse($especialidade->jsonSerialize());
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @Route("/especialidade/{id}", methods={"DELETE"})
     */
    public function delete(int $id): JsonResponse
    {
        $especialidade = $this->especialidadeRepository->find($id);

        if (is_null($especialidade)) {
            return new JsonResponse("", JsonResponse::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($especialidade);
        $this->entityManager->flush();

        return new JsonResponse("", JsonResponse::HTTP_NO_CONTENT);
    }
}
