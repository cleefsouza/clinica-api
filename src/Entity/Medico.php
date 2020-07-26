<?php

namespace App\Entity;

use App\Repository\MedicoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Medico
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass=MedicoRepository::class)
 * @ORM\Table(name="medico")
 */
class Medico implements \JsonSerializable
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
     * @var Especialidade
     *
     * @ORM\ManyToOne(targetEntity=Especialidade::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private Especialidade $especialidade;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCrm(): string
    {
        return $this->crm;
    }

    /**
     * @param string $crm
     * @return Medico
     */
    public function setCrm(string $crm): Medico
    {
        $this->crm = $crm;

        return $this;
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
     * @return Medico
     */
    public function setNome(string $nome): Medico
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return Especialidade
     */
    public function getEspecialidade(): Especialidade
    {
        return $this->especialidade;
    }

    /**
     * @param Especialidade $especialidade
     * @return Medico
     */
    public function setEspecialidade(Especialidade $especialidade): Medico
    {
        $this->especialidade = $especialidade;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            "id" => $this->getId(),
            "nome" => $this->getNome(),
            "crm" => $this->getCrm(),
            "especialidade_id" => $this->getEspecialidade()->getId(),
            "_links" => [
                [
                    "rel" => "self",
                    "path" => "/medico/{$this->getId()}"
                ],
                [
                    "rel" => "especialidade",
                    "path" => "/especialidade/{$this->getEspecialidade()->getId()}"
                ]
            ]
        ];
    }
}
