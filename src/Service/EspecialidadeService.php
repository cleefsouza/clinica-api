<?php

namespace App\Service;

use App\Entity\Especialidade;
use App\ServiceInterface\EntityServiceInterface;

/**
 * Class EspecialidadeService
 * @package App\Service
 */
class EspecialidadeService implements EntityServiceInterface
{

    /**
     * @param string $json
     * @return Especialidade
     */
    public function createEntity(string $json): Especialidade
    {
        $data = json_decode($json);

        $especialidade = new Especialidade();
        $especialidade->setDescricao($data->descricao);

        return $especialidade;
    }
}
