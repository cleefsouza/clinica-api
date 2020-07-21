<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\{
    JsonResponse,
    Request
};

/**
 * Class IndexController
 * @package App\Controller
 */
class IndexController extends AbstractController
{

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/", methods={"GET"})
     */
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            [
                "nome" => "clinica-api",
                "descricao" => "Cadastro de médicos e especialidades",
                "uri" => $request->getUri(),
                "method" => $request->getMethod()
            ]
        );
    }
}
