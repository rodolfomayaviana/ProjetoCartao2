<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UnidadeGestora
 *
 * @ORM\Table(name="unidade_gestora")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UnidadeGestoraRepository")
 */
class UnidadeGestora
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeDaUnidadeGestora", type="string", length=255)
     */
    private $nomeDaUnidadeGestora;

    /**
     * Set id
     *
     * @param int $idUnidade
     *
     * @return UnidadeGestora
     */
    public function setId($idUnidadeGestora)
    {
        $this->id = $idUnidadeGestora;

        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomeDaUnidadeGestora
     *
     * @param string $nomeDaUnidadeGestora
     *
     * @return UnidadeGestora
     */
    public function setNomeDaUnidadeGestora($nomeDaUnidadeGestora)
    {
        $this->nomeDaUnidadeGestora = $nomeDaUnidadeGestora;

        return $this;
    }

    /**
     * Get nomeDaUnidadeGestora
     *
     * @return string
     */
    public function getNomeDaUnidadeGestora()
    {
        return $this->nomeDaUnidadeGestora;
    }
}

