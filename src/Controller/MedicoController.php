<?php

namespace App\Controller;

use App\Entity\Medico;
use App\Repository\MedicoRepository;
use App\Service\MedicoFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MedicoController
 * @package App\Controller
 */
class MedicoController extends AbstractController
{

    /**
     * @var MedicoFactory
     */
    private MedicoFactory $medicoFactory;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;
    /**
     * @var MedicoRepository
     */
    private MedicoRepository $medicoRepository;

    /**
     * MedicoController constructor.
     * @param EntityManagerInterface $entityManager
     * @param MedicoFactory $medicoFactory
     * @param MedicoRepository $medicoRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        MedicoFactory $medicoFactory,
        MedicoRepository $medicoRepository
    ) {
        $this->entityManager = $entityManager;
        $this->medicoFactory = $medicoFactory;
        $this->medicoRepository = $medicoRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/medico", methods={"POST"})
     */
    public function create(Request $request): JsonResponse
    {
        $body = $request->getContent();
        $medico = $this->medicoFactory->criarMedico($body);

        $this->entityManager->persist($medico);
        $this->entityManager->flush();

        return new JsonResponse($medico);
    }

    /**
     * @return JsonResponse
     *
     * @Route("/medico", methods={"GET"})
     */
    public function readAll(): JsonResponse
    {
        $medicos = $this->medicoRepository->findAll();

        return new JsonResponse($medicos);
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @Route("/medico/{id}", methods={"GET"})
     */
    public function read(int $id): JsonResponse
    {
        $medico = $this->medicoRepository->find($id);

        if (is_null($medico)) {
            return new JsonResponse("", JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse($medico->getNome());
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/medico/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request): JsonResponse
    {
        $body = $request->getContent();
        $novoMedico = $this->medicoFactory->criarMedico($body);

        $medico = $this->medicoRepository->find($id);

        if (is_null($medico)) {
            return new JsonResponse("", JsonResponse::HTTP_NOT_FOUND);
        }

        $medico->setCrm($novoMedico->getCrm());
        $medico->setNome($novoMedico->getNome());

        $this->entityManager->flush();

        return new JsonResponse($medico);
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @Route("/medico/{id}", methods={"DELETE"})
     */
    public function delete(int $id): JsonResponse
    {
        $medico = $this->medicoRepository->find($id);

        if (is_null($medico)) {
            return new JsonResponse("", JsonResponse::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($medico);
        $this->entityManager->flush();

        return new JsonResponse("", JsonResponse::HTTP_NO_CONTENT);
    }
}
