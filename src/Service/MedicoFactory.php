<?php

namespace App\Service;

use App\Entity\Medico;
use App\Repository\EspecialidadeRepository;

/**
 * Class MedicoFactory
 * @package App\Service
 */
class MedicoFactory
{
    /**
     * @var EspecialidadeRepository
     */
    private EspecialidadeRepository $especialidadeRepository;

    /**
     * MedicoFactory constructor.
     * @param EspecialidadeRepository $especialidadeRepository
     */
    public function __construct(EspecialidadeRepository $especialidadeRepository)
    {
        $this->especialidadeRepository = $especialidadeRepository;
    }

    /**
     * @param string $json
     * @return Medico
     */
    public function criarMedico(string $json): Medico
    {
        $data = json_decode($json);

        $especialidade = $this->especialidadeRepository->find($data->especialidade_id);

        $medico = new Medico();
        $medico
            ->setCrm($data->crm)
            ->setNome($data->nome)
            ->setEspecialidade($especialidade);

        return $medico;
    }
}
