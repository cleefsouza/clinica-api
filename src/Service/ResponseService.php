<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseService
{

    /**
     * @var bool
     */
    private bool $sucesso;

    /**
     * @var int|null
     */
    private ?int $pagina;

    /**
     * @var int|null
     */
    private ?int $limite;

    /**
     * @var mixed|null
     */
    private $conteudo;

    /**
     * @var int
     */
    private int $status;

    /**
     * ResponseService constructor.
     * @param $conteudo
     * @param int $status
     * @param bool $sucesso
     * @param int|null $pagina
     * @param int|null $limite
     */
    public function __construct($conteudo, int $status, bool $sucesso, int $pagina = null, int $limite = null)
    {
        $this->conteudo = $conteudo;
        $this->status = $status;
        $this->sucesso = $sucesso;
        $this->pagina = $pagina;
        $this->limite = $limite;
    }

    /**
     * @return JsonResponse
     */
    public function getResponse(): JsonResponse
    {
        $conteudo = [
            "conteudo" => $this->conteudo,
            "status" => $this->status,
            "sucesso" => $this->sucesso,
            "pagina" => $this->pagina,
            "limite" => $this->limite,
        ];

        $response = array_filter(
            $conteudo,
            function ($item) {
                return !empty($item);
            }
        );

        return new JsonResponse($response);
    }
}
