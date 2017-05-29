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

        public function __construct ($container) {

		$this->container = $container;
        	return;
	}

	public function getGastoes($ano, $mes) {

	        $DBController = new DatabaseController($this->container);
	        $DBController->conectaDB();
	        $retorno = $DBController->executaSQL('SELECT    nomePortador ,
								codigoOrgaoSuperior,
								codigoOrgaoSubordinado,
								codigoUnidadeGestora,
								valorTransacao
						      FROM gasto
					      	      GROUP BY
								 nomePortador,
                                                        	 codigoOrgaoSuperior,
                                                   	         codigoOrgaoSubordinado,
                                                        	 codigoUnidadeGestora
							ORDER BY
								valorTransacao DESC');


	        $DBController->desconectaDB();

		return $retorno;

	}


        public function getGastosPorOrgao($orgao) {

                $DBController = new DatabaseController($this->container);
                $DBController->conectaDB();
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
                          WHERE codigoOrgaoSubordinado = " . $orgao;

                $retorno = $DBController->executaSQL($query);


                $DBController->desconectaDB();

                return $retorno;

        }

        public function getGastosPorPortador($portador) {

                $DBController = new DatabaseController($this->container);
                $DBController->conectaDB();
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

                $retorno = $DBController->executaSQL($query);


                $DBController->desconectaDB();

                return $retorno;

        }


        public function getGastosPorFavorecido($codigoFavorecido) {

                $DBController = new DatabaseController($this->container);
                $DBController->conectaDB();
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
                          WHERE codigoFavorecido = \"" . $codigoFavorecido . "\"";

                $retorno = $DBController->executaSQL($query);


                $DBController->desconectaDB();

                return $retorno;

	}

        public function getSacadores($ano, $mes) {

                $DBController = new DatabaseController($this->container);
                $DBController->conectaDB();
                $retorno = $DBController->executaSQL('SELECT    nomePortador ,
                                                                codigoOrgaoSuperior,
                                                                codigoOrgaoSubordinado,
                                                                codigoUnidadeGestora,
                                                                valorTransacao
                                                      FROM gasto
						      WHERE nomeTransacao = "SAQUE CASH/ATM BB"
                                                      GROUP BY
                                                                 nomePortador,
                                                                 codigoOrgaoSuperior,
                                                                 codigoOrgaoSubordinado,
                                                                 codigoUnidadeGestora
                                                        ORDER BY
                                                                valorTransacao DESC');


                $DBController->desconectaDB();

                return $retorno;

        }


}
