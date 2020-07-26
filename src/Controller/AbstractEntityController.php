<?php

namespace App\Controller;

use App\Service\ResponseService;
use App\Utils\FiltroRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectRepository;
use App\ServiceInterface\EntityServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\{
    JsonResponse,
    Request
};

/**
 * Class AbstractEntityController
 * @package App\Controller
 */
abstract class AbstractEntityController extends AbstractController
{

    /**
     * @var ObjectRepository
     */
    protected ObjectRepository $repository;

    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;

    /**
     * @var EntityServiceInterface
     */
    protected EntityServiceInterface $entityService;

    /**
     * @var FiltroRequest
     */
    protected FiltroRequest $filtroRequest;

    /**
     * AbstractEntityController constructor.
     * @param ObjectRepository $repository
     * @param EntityManagerInterface $entityManager
     * @param EntityServiceInterface $entityService
     * @param FiltroRequest $filtroRequest
     */
    public function __construct(
        ObjectRepository $repository,
        EntityManagerInterface $entityManager,
        EntityServiceInterface $entityService,
        FiltroRequest $filtroRequest
    ) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->entityService = $entityService;
        $this->filtroRequest = $filtroRequest;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $body = $request->getContent();
        $entity = $this->entityService->createEntity($body);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        $response = new ResponseService(
            $entity,
            JsonResponse::HTTP_OK,
            true
        );

        return $response->getResponse();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function read(int $id): JsonResponse
    {
        $entity = $this->repository->find($id);

        if (empty($entity)) {
            return new JsonResponse("", JsonResponse::HTTP_NOT_FOUND);
        }

        $response = new ResponseService(
            $entity,
            JsonResponse::HTTP_OK,
            true
        );

        return $response->getResponse();
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $id, Request $request): JsonResponse
    {
        $body = $request->getContent();
        $newEntity = $this->entityService->createEntity($body);

        $entity = $this->repository->find($id);

        if (empty($entity)) {
            return new JsonResponse("", JsonResponse::HTTP_NOT_FOUND);
        }

        $this->updateEntity($entity, $newEntity);
        $this->entityManager->flush();

        $response = new ResponseService(
            $entity,
            JsonResponse::HTTP_OK,
            true
        );

        return $response->getResponse();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $entity = $this->repository->find($id);

        if (empty($entity)) {
            return new JsonResponse("", JsonResponse::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($entity);
        $this->entityManager->flush();

        return new JsonResponse("", JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function readAll(Request $request): JsonResponse
    {
        $filtros = $this->filtroRequest->getFiltros($request);
        $order = $this->filtroRequest->getOrder($request);
        [$page, $limit, $offset] = $this->filtroRequest->getPages($request);

        $entityList = $this->repository->findBy($filtros, $order, $limit, $offset);

        if (empty($entityList)) {
            return new JsonResponse("", JsonResponse::HTTP_NOT_FOUND);
        }

        $response = new ResponseService(
            $entityList,
            JsonResponse::HTTP_OK,
            true,
            $page,
            $limit
        );

        return $response->getResponse();
    }

    /**
     * @param $entity
     * @param $newEntity
     * @return mixed
     */
    abstract public function updateEntity($entity, $newEntity);
}
