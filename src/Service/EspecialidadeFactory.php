<?php

namespace App\Service;

use App\Entity\Especialidade;

/**
 * Class EspecialidadeFactory
 * @package App\Service
 */
class EspecialidadeFactory
{

    /**
     * @param string $json
     * @return Especialidade
     */
    public function criarEspecialidade(string $json): Especialidade
    {
        $data = json_decode($json);

        $especialidade = new Especialidade();
        $especialidade->setDescricao($data->descricao);

        return $especialidade;
    }
}
