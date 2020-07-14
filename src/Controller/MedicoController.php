<?php

namespace App\Controller;

use App\Entity\Medico;
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
    private EntityManagerInterface $entityManagerInterface;

    /**
     * MedicoController constructor.
     * @param EntityManagerInterface $entityManagerInterface
     * @param MedicoFactory $medicoFactory
     */
    public function __construct(EntityManagerInterface $entityManagerInterface, MedicoFactory $medicoFactory)
    {
        $this->entityManagerInterface = $entityManagerInterface;
        $this->medicoFactory = $medicoFactory;
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

        $this->entityManagerInterface->persist($medico);
        $this->entityManagerInterface->flush();

        return new JsonResponse($medico);
    }

    /**
     * @return JsonResponse
     *
     * @Route("/medico", methods={"GET"})
     */
    public function readAll(): JsonResponse
    {
        $medicos = $this->getDoctrine()->getRepository(Medico::class)->findAll();

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
        $medico = $this->getDoctrine()->getRepository(Medico::class)->find($id);

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

        $medico = $this->getDoctrine()->getRepository(Medico::class)->find($id);

        if (is_null($medico)) {
            return new JsonResponse("", JsonResponse::HTTP_NOT_FOUND);
        }

        $medico->setCrm($novoMedico->getCrm());
        $medico->setNome($novoMedico->getNome());

        $this->entityManagerInterface->flush();

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
        $medico = $this->getDoctrine()->getRepository(Medico::class)->find($id);

        if (is_null($medico)) {
            return new JsonResponse("", JsonResponse::HTTP_NOT_FOUND);
        }

        $this->entityManagerInterface->remove($medico);
        $this->entityManagerInterface->flush();

        return new JsonResponse("", JsonResponse::HTTP_OK);
    }
}
