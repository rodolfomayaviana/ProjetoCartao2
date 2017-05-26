<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Portador
 *
 * @ORM\Table(name="portador")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PortadorRepository")
 */
class Portador
{

    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="nomePortador", type="string", length=255)
     */
    private $nomePortador;

    /**
     * @var string
     *
     * @ORM\Column(name="codigoDoOrgao", type="string", length=255)
     */
    private $codigoDoOrgao;

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
     * Set codigoDoOrgao
     *
     * @param string $codigoDoOrgao
     *
     * @return Portador
     */
    public function setCodigoDoOrgao($codigoDoOrgao)
    {
        $this->codigoDoOrgao = $codigoDoOrgao;

        return $this;
    }

    /**
     * Get codigoDoOrgao
     *
     * @return string
     */
    public function getCodigoDoOrgao()
    {
        return $this->codigoDoOrgao;
    }
}

