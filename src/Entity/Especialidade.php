<?php

namespace App\Entity;

use App\Repository\EspecialidadeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Especialidade
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass=EspecialidadeRepository::class)
 * @ORM\Table(name="especialidade")
 */
class Especialidade implements \JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $descricao;

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
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     * @return Especialidade
     */
    public function setDescricao(string $descricao): Especialidade
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            "id" => $this->getId(),
            "descricao" => $this->getDescricao(),
            "_links" => [
                [
                    "rel" => "self",
                    "path" => "/especialidade/{$this->getId()}"
                ]
            ]
        ];
    }
}
