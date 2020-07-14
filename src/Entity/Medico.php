<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Medico
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="medico")
 */
class Medico
{

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $crm;

    /**
     * @var string
     * @ORM\Column(type="string")
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
