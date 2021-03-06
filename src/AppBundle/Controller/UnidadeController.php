<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\UnidadeGestora;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class UnidadeController extends Controller {

	private $em;

        public function __construct ($em) {

		$this->em = $em;
        	return;
	}

	public function createUnidade($idUnidade , $nomeUnidade )  {

		$unidadeGestora = new UnidadeGestora();
		$unidadeGestora->setNomeDaUnidadeGestora($nomeUnidade);
		$unidadeGestora->setId($idUnidade);
		$this->em->persist($unidadeGestora);
                $this->em->flush();
		return $unidadeGestora;

	}

	public function getUnidadeById ($idUnidade) {

		$unidadeGestora =  $this->em->getRepository('AppBundle:UnidadeGestora')->find($idUnidade);
		return $unidadeGestora;
	}
}
