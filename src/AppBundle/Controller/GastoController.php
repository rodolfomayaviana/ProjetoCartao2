<?php

namespace AppBundle\Controller;

//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\Gasto;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use AppBundle\Service\GastoService;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations\Route;


class GastoController extends FOSRestController {

	private $em;
	protected $container;

        public function __construct ($em, $container) {
		$this->container = $container;
		$this->em = $em;
 	      	return;
	}


	public function createGasto($orgaoSuperior, $orgaoSubordinado, $unidadeGestora, $anoExtrato, $mesExtrato, $portador,
			$nomeTransacao, $dataTransacao, $favorecido, $valorTransacao )  {

		$Gasto = new Gasto();
		$Gasto->setCodigoOrgaoSuperior($orgaoSuperior);
		$Gasto->setCodigoOrgaoSubordinado($orgaoSubordinado);
                $Gasto->setCodigoUnidadeGestora($unidadeGestora);
                $Gasto->setAnoTransacao($anoExtrato);
                $Gasto->setMesTransacao($mesExtrato);
                $Gasto->setNomePortador($portador);
                $Gasto->setNomeTransacao($nomeTransacao);
                $Gasto->setDataTransacao($dataTransacao);
                $Gasto->setCodigoFavorecido($favorecido);
                $Gasto->setValorTransacao($valorTransacao);

		$this->em->persist($Gasto);
                $this->em->flush();
	}

        public function createGastoFromGastoes($orgaoSuperior, $orgaoSubordinado, $unidadeGestora, $portador, $valorTransacao) {

                $Gasto = new Gasto();
                $Gasto->setCodigoOrgaoSuperior($orgaoSuperior);
                $Gasto->setCodigoOrgaoSubordinado($orgaoSubordinado);
                $Gasto->setCodigoUnidadeGestora($unidadeGestora);
                $Gasto->setNomePortador($portador);
		$Gasto->setValorTransacao($valorTransacao);

		return $Gasto;
        }

	public function getGastoById ($idGasto) {

		$gasto =  $this->em->getRepository('AppBundle:Gasto')->find($idGasto);
		return $gasto;
	}

	public function getGastoes ()
 	{
		$gastoService = new GastoService($this->container, $this->getDoctrine()->getManager());
		$mysqlFetch = $gastoService->getGastoes();
		$gastoes = array();
                foreach ($mysqlFetch as $row) {

		             array_push($gastoes, $this->createGastoFromGastoes($row["codigoOrgaoSuperior"],
						$row["codigoOrgaoSubordinado"],
						$row["contador"],
						$row["nomePortador"],
						$row["valorTransacao"]));
		}

		return $gastoes;
	}



        public function getGastosPorOrgao ()
        {
                $gastoService = new GastoService($this->container, $this->getDoctrine()->getManager());
                $mysqlFetch = $gastoService->getGastosPorOrgao();

                $gastosPorOrgao = array();

            foreach ($mysqlFetch as $row) {

                             array_push($gastosPorOrgao, $this->createGastoFromOrgao($row["codigoOrgaoSuperior"],
                                                $row["codigoOrgaoSubordinado"],
                                                $row["contador"],
                                                $row["valorTransacao"]));
                }

                return $gastosPorOrgao;
        }

        public function createGastoFromOrgao($orgaoSuperior, $orgaoSubordinado, $unidadeGestora, $valorTransacao) {

                $Gasto = new Gasto();
                $Gasto->setCodigoOrgaoSuperior($orgaoSuperior);
                $Gasto->setCodigoOrgaoSubordinado($orgaoSubordinado);
                $Gasto->setCodigoUnidadeGestora($unidadeGestora);
                $Gasto->setValorTransacao($valorTransacao);

                return $Gasto;
        }

        public function getGastosPorFavorecido ()

        {
                $gastoService = new GastoService($this->container, $this->getDoctrine()->getManager());
                $mysqlFetch = $gastoService->getGastosPorFavorecido();

                $gastosPorFavorecido = array();

            foreach ($mysqlFetch as $row) {

                             array_push($gastosPorFavorecido, $this->createGastoFromFavorecido($row["codigoFavorecido"],
						$row["contador"],
                                                $row["valorTransacao"]));
                		}


                return $gastosPorFavorecido;
        }

        public function createGastoFromFavorecido($codigoFavorecido, $unidadeGestora, $valorTransacao) {

                $Gasto = new Gasto();
                $Gasto->setCodigoFavorecido($codigoFavorecido);
                $Gasto->setCodigoUnidadeGestora($unidadeGestora);
                $Gasto->setValorTransacao($valorTransacao);

                return $Gasto;
        }



        public function getSacadores ()
        {
                $gastoService = new GastoService($this->container, $this->getDoctrine()->getManager());
                $mysqlFetch = $gastoService->getSacadores();

                $sacadores = array();

            foreach ($mysqlFetch as $row) {

                             array_push($sacadores, $this->createGastoFromGastoes($row["codigoOrgaoSuperior"],
                                                $row["codigoOrgaoSubordinado"],
                                                $row["contador"],
                                                $row["nomePortador"],
                                                $row["valorTransacao"]));
                }

                return $sacadores;
        }

}
