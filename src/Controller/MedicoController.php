<?php

namespace App\Controller;

use App\Entity\Medico;
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
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManagerInterface;

    /**
     * MedicoController constructor.
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
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
        $json = json_decode($body);

        $medico = new Medico();
        $medico->setCrm($json->crm);
        $medico->setNome($json->nome);

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
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/medico/{id}", methods={"GET"})
     */
    public function read(Request $request): JsonResponse
    {
        $id = $request->get('id');
        $medico = $this->getDoctrine()->getRepository(Medico::class)->find($id);

        $httpCode = JsonResponse::HTTP_OK;

        if (is_null($medico)) {
            $httpCode = JsonResponse::HTTP_NOT_FOUND;
        }

        return new JsonResponse($medico, $httpCode);
    }
}
