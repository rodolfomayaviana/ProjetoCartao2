<?php

namespace AppBundle\Service;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Gasto;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use AppBundle\Controller\DatabaseController;

class GastoService extends Controller {

	protected $container;
	private $em;

    public function __construct ($container, $em) {

		$this->container = $container;
		$this->em = $em;
	}

	public function getGastoes() {

        $sql = "SELECT    nomePortador ,
								codigoOrgaoSuperior,
								codigoOrgaoSubordinado,
								codigoUnidadeGestora,
								count(*) as contador,
								sum(valorTransacao) as valorTransacao
						      FROM gasto
					      	      GROUP BY
								 nomePortador,
                                                        	 codigoOrgaoSuperior,
                                                   	         codigoOrgaoSubordinado,
                                                        	 codigoUnidadeGestora
							ORDER BY
								valorTransacao DESC";


        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();
        $retorno = $stmt->fetchAll();
		return $retorno;

	}


        public function getGastosPorOrgao($orgao) {


        $sql = "SELECT    nomePortador ,
                                                                codigoOrgaoSuperior,
                                                                codigoOrgaoSubordinado,
                                                                codigoUnidadeGestora,
                                                                count(*) as contador,
                                                                sum(valorTransacao) as valorTransacao
                                                      FROM gasto
                                                      GROUP BY
                                                                 codigoOrgaoSuperior,
                                                                 codigoOrgaoSubordinado,
                                                                 codigoUnidadeGestora
                                                        ORDER BY
                                                                valorTransacao DESC";

        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();

        }

        public function getGastosPorPortador($portador) {

            $query = "SELECT                codigoOrgaoSuperior,
                                            codigoOrgaoSubordinado,
                                            codigoUnidadeGestora,
                                            anoTransacao,
                                            mesTransacao,
                                            nomeTransacao,
                                            nomePortador,
                                            codigoFavorecido,
                                            dataTransacao,
                                            valorTransacao
                      FROM gasto
                      WHERE nomePortador = \"" . $portador . "\"";

            $stmt = $this->em->getConnection()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();

        }


        public function getGastosPorFavorecido($codigoFavorecido) {
        $sql = "SELECT    nomePortador ,
                                                                codigoFavorecido,
                                                                count(*) as contador,
                                                                sum(valorTransacao) as valorTransacao
                                                      FROM gasto
                                                      GROUP BY
                                                                 codigoFavorecido
                                                        ORDER BY
                                                                valorTransacao DESC";

            $stmt = $this->em->getConnection()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();

	}

        public function getSacadores($ano, $mes) {

                $query = 'SELECT    nomePortador ,
                                                                codigoOrgaoSuperior,
                                                                codigoOrgaoSubordinado,
                                                                codigoUnidadeGestora,
								count(*) as contador,
                                                                sum(valorTransacao) as valorTransacao
                                                      FROM gasto
						      WHERE nomeTransacao = "SAQUE CASH/ATM BB"
                                                      GROUP BY
                                                                 nomePortador,
                                                                 codigoOrgaoSuperior,
                                                                 codigoOrgaoSubordinado,
                                                                 codigoUnidadeGestora
                                                        ORDER BY
                                                                valorTransacao DESC';


            $stmt = $this->em->getConnection()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();

        }

        public function deleteAll() {

                $query = "DELETE FROM gasto
			where id > 0";

            $stmt = $this->em->getConnection()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();

        }

}
