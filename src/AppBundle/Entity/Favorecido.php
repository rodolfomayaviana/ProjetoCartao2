<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favorecido
 *
 * @ORM\Table(name="favorecido")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FavorecidoRepository")
 */
class Favorecido
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NomeDoFavorecido", type="string", length=255)
     */
    private $nomeDoFavorecido;

    /**
     * Set id
     *
     * @param int $idFavorecido
     *
     * @return Favorecido
     */
    public function setId($idFavorecido)
    {
        $this->id = $idFavorecido;

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
     * Set nomeDoFavorecido
     *
     * @param string $nomeDoFavorecido
     *
     * @return Favorecido
     */
    public function setNomeDoFavorecido($nomeDoFavorecido)
    {
        $this->nomeDoFavorecido = $nomeDoFavorecido;

        return $this;
    }

    /**
     * Get nomeDoFavorecido
     *
     * @return string
     */
    public function getNomeDoFavorecido()
    {
        return $this->nomeDoFavorecido;
    }
}

