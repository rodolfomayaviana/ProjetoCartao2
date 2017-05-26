<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orgao
 *
 * @ORM\Table(name="orgao")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrgaoRepository")
 */
class Orgao
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
     * @ORM\Column(name="nomeDoOrgao", type="string", length=255)
     */
    private $nomeDoOrgao;

    /**
     * Set id
     *
     * @param int $idOrgao
     *
     * @return Orgao
     */
    public function setId($idOrgao)
    {
        $this->id = $idOrgao;

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
     * Set nomeDoOrgao
     *
     * @param string $nomeDoOrgao
     *
     * @return Orgao
     */
    public function setNomeDoOrgao($nomeDoOrgao)
    {
        $this->nomeDoOrgao = $nomeDoOrgao;

        return $this;
    }

    /**
     * Get nomeDoOrgao
     *
     * @return string
     */
    public function getNomeDoOrgao()
    {
        return $this->nomeDoOrgao;
    }
}

