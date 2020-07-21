<?php

namespace App\Service;

use App\Entity\Medico;
use App\Repository\EspecialidadeRepository;
use App\ServiceInterface\EntityServiceInterface;

/**
 * Class MedicoService
 * @package App\Service
 */
class MedicoService implements EntityServiceInterface
{
    /**
     * @var EspecialidadeRepository
     */
    private EspecialidadeRepository $especialidadeRepository;

    /**
     * MedicoService constructor.
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
    public function createEntity(string $json): Medico
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
