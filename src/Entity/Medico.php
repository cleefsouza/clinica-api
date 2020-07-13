<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Medico
 * @package App\Entity
 *
 * @ORM\Entity()
 */
class Medico
{

    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $crm;

    /**
     * @var string
     */
    private string $nome;

    /**
     * @return string
     */
    public function getCrm(): string
    {
        return $this->crm;
    }

    /**
     * @param string $crm
     */
    public function setCrm(string $crm): void
    {
        $this->crm = $crm;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }
}
