<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gasto
 *
 * @ORM\Table(name="gasto")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GastoRepository")
 */
class Gasto
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="codigoOrgaoSuperior", type="integer")
     */
    private $codigoOrgaoSuperior;

    /**
     * @var int
     *
     * @ORM\Column(name="codigoOrgaoSubordinado", type="integer")
     */
    private $codigoOrgaoSubordinado;

    /**
     * @var string
     *
     * @ORM\Column(name="codigoUnidadeGestora", type="string", length=255)
     */
    private $codigoUnidadeGestora;

    /**
     * @var int
     *
     * @ORM\Column(name="anoTransacao", type="integer")
     */
    private $anoTransacao;

    /**
     * @var int
     *
     * @ORM\Column(name="mesTransacao", type="integer")
     */
    private $mesTransacao;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeTransacao", type="string", length=255)
     */
    private $nomeTransacao;

    /**
     * @var string
     *
     * @ORM\Column(name="nomePortador", type="string", length=255)
     */
    private $nomePortador;

    /**
     * @var int
     *
     * @ORM\Column(name="codigoFavorecido", type="bigint")
     */
    private $codigoFavorecido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataTransacao", type="date")
     */
    private $dataTransacao;

    /**
     * @var string
     *
     * @ORM\Column(name="valorTransacao", type="decimal", precision=10, scale=2)
     */
    private $valorTransacao;


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
     * Set codigoOrgaoSuperior
     *
     * @param integer $codigoOrgaoSuperior
     *
     * @return Gasto
     */
    public function setCodigoOrgaoSuperior($codigoOrgaoSuperior)
    {
        $this->codigoOrgaoSuperior = $codigoOrgaoSuperior;

        return $this;
    }

    /**
     * Get codigoOrgaoSuperior
     *
     * @return int
     */
    public function getCodigoOrgaoSuperior()
    {
        return $this->codigoOrgaoSuperior;
    }

    /**
     * Set codigoOrgaoSubordinado
     *
     * @param integer $codigoOrgaoSubordinado
     *
     * @return Gasto
     */
    public function setCodigoOrgaoSubordinado($codigoOrgaoSubordinado)
    {
        $this->codigoOrgaoSubordinado = $codigoOrgaoSubordinado;

        return $this;
    }

    /**
     * Get codigoOrgaoSubordinado
     *
     * @return int
     */
    public function getCodigoOrgaoSubordinado()
    {
        return $this->codigoOrgaoSubordinado;
    }

    /**
     * Set codigoUnidadeGestora
     *
     * @param string $codigoUnidadeGestora
     *
     * @return Gasto
     */
    public function setCodigoUnidadeGestora($codigoUnidadeGestora)
    {
        $this->codigoUnidadeGestora = $codigoUnidadeGestora;

        return $this;
    }

    /**
     * Get codigoUnidadeGestora
     *
     * @return string
     */
    public function getCodigoUnidadeGestora()
    {
        return $this->codigoUnidadeGestora;
    }

    /**
     * Set anoTrasacao
     *
     * @param integer $anoTrasacao
     *
     * @return Gasto
     */
    public function setAnoTransacao($anoTransacao)
    {
        $this->anoTransacao = $anoTransacao;

        return $this;
    }

    /**
     * Get anoTrasacao
     *
     * @return int
     */
    public function getAnoTransacao()
    {
        return $this->anoTrasacao;
    }

    /**
     * Set mesTransacao
     *
     * @param integer $mesTransacao
     *
     * @return Gasto
     */
    public function setMesTransacao($mesTransacao)
    {
        $this->mesTransacao = $mesTransacao;

        return $this;
    }

    /**
     * Get mesTransacao
     *
     * @return int
     */
    public function getMesTransacao()
    {
        return $this->mesTransacao;
    }

    /**
     * Set nomePortador
     *
     * @param string $nomePortador
     *
     * @return Gasto
     */
    public function setNomePortador($nomePortador)
    {
        $this->nomePortador = $nomePortador;

        return $this;
    }

    /**
     * Get nomePortador
     *
     * @return string
     */
    public function getNomePortador()
    {
        return $this->nomePortador;
    }

   /**
     * Set nomeTransacao
     *
     * @param string $nomeTransacao
     *
     * @return Gasto
     */
    public function setNomeTransacao($nomeTransacao)
    {
        $this->nomeTransacao = $nomeTransacao;

        return $this;
    }

    /**
     * Get nomeTransacao
     *
     * @return string
     */
    public function getNomeTransacao()
    {
        return $this->nomeTransacao;
    }


    /**
     * Set codigoFavorecido
     *
     * @param integer $codigoFavorecido
     *
     * @return Gasto
     */
    public function setCodigoFavorecido($codigoFavorecido)
    {
        $this->codigoFavorecido = $codigoFavorecido;

        return $this;
    }

    /**
     * Get codigoFavorecido
     *
     * @return int
     */
    public function getCodigoFavorecido()
    {
        return $this->codigoFavorecido;
    }

    /**
     * Set dataTransacao
     *
     * @param \DateTime $dataTransacao
     *
     * @return Gasto
     */
    public function setDataTransacao($dataTransacao)
    {
        $this->dataTransacao = $dataTransacao;

        return $this;
    }

    /**
     * Get dataTransacao
     *
     * @return \DateTime
     */
    public function getDataTransacao()
    {
        return $this->dataTransacao;
    }

    /**
     * Set valorTransacao
     *
     * @param string $valorTransacao
     *
     * @return Gasto
     */
    public function setValorTransacao($valorTransacao)
    {
        $this->valorTransacao = $valorTransacao;

        return $this;
    }

    /**
     * Get valorTransacao
     *
     * @return string
     */
    public function getValorTransacao()
    {
        return $this->valorTransacao;
    }
}

