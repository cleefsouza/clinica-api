<?php

namespace App\Controller;

use App\Entity\Medico;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MedicoController
 * @package App\Controller
 */
class MedicoController
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
}
