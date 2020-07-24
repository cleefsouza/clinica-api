<?php

namespace App\Controller;

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
     * AbstractEntityController constructor.
     * @param ObjectRepository $repository
     * @param EntityManagerInterface $entityManager
     * @param EntityServiceInterface $entityService
     */
    public function __construct(
        ObjectRepository $repository,
        EntityManagerInterface $entityManager,
        EntityServiceInterface $entityService
    ) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->entityService = $entityService;
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

        return new JsonResponse($entity, JsonResponse::HTTP_OK);
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

        return new JsonResponse($entity, JsonResponse::HTTP_OK);
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

        return new JsonResponse($entity);
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
        $order = $request->query->get('order');
        $entityList = $this->repository->findBy([], $order);

        if (empty($entityList)) {
            return new JsonResponse("", JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse($entityList, JsonResponse::HTTP_OK);
    }

    /**
     * @param $entity
     * @param $newEntity
     * @return mixed
     */
    abstract public function updateEntity($entity, $newEntity);
}
