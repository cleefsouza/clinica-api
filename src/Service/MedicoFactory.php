<?php

namespace App\Service;

use App\Entity\Medico;

/**
 * Class MedicoFactory
 * @package App\Service
 */
class MedicoFactory
{

    /**
     * @param string $json
     * @return Medico
     */
    public function criarMedico(string $json): Medico
    {
        $data = json_decode($json);

        $medico = new Medico();
        $medico->setCrm($data->crm);
        $medico->setNome($data->nome);

        return $medico;
    }
}
