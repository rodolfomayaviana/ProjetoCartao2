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

	public function getGastoes ($ano, $mes)
 	{
		$gastoService = new GastoService($this->container);
		$mysqlFetch = $gastoService->getGastoes($ano, $mes);

		$gastoes = array();

                while ($row = $mysqlFetch->fetch_assoc()) {

		             array_push($gastoes, $this->createGastoFromGastoes($row["codigoOrgaoSuperior"],
						$row["codigoOrgaoSubordinado"],
						$row["codigoUnidadeGestora"],
						$row["nomePortador"],
						$row["valorTransacao"]));
		}

		return $gastoes;
	}



        public function getGastosPorOrgao ($orgao)
        {
                $gastoService = new GastoService($this->container);
                $mysqlFetch = $gastoService->getGastosPorOrgao($orgao);

                $gastoes = array();

                while ($row = $mysqlFetch->fetch_assoc()) {

                             array_push($gastoes, $this->createGastoFromOrgao($row["codigoOrgaoSuperior"],
                                                $row["codigoOrgaoSubordinado"],
                                                $row["codigoUnidadeGestora"],
                                                $row["anoTransacao"],
                                                $row["mesTransacao"],
                                                $row["nomeTransacao"],
                                                $row["nomePortador"],

                                                $row["valorTransacao"]));
                }

                return $gastoes;
        }


        public function createGastoFromOrgao($orgaoSuperior, $orgaoSubordinado, $unidadeGestora, $anoTransacao, $mesTransacao, $nomeTransacao, 
						$nomePortador, $codigoFavorecido, $dataTransacao,  $valorTransacao) {

                $Gasto = new Gasto();
                $Gasto->setCodigoOrgaoSuperior($orgaoSuperior);
                $Gasto->setCodigoOrgaoSubordinado($orgaoSubordinado);
                $Gasto->setCodigoUnidadeGestora($unidadeGestora);
		$Gasto->setAnoTransacao($anoTransacao);
		$Gasto->setMesTransacao($mesTransacao);
		$Gasto->setNomeTransacao($nomeTransacao);
		$Gasto->setCodigoFavorecido($codigoFavorecido);
		$Gasto->setDataTransacao($dataTransacao);
                $Gasto->setNomePortador($portador);
                $Gasto->setValorTransacao($valorTransacao);

                return $Gasto;
        }










}
