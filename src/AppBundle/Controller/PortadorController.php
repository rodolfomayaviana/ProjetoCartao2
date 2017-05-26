<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Portador;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class PortadorController extends Controller {

	private $em;

        public function __construct ($em) {

		$this->em = $em;
        	return;
	}

	public function createPortador($nomePortador , $codigoDoOrgao )  {

		$Portador = new Portador($nomePortador , $codigoDoOrgao);
		$Portador->setNomePortador($nomePortador);
		$Portador->setCodigoDoOrgao($codigoDoOrgao);
		$this->em->persist($Portador);
                $this->em->flush();
		return $Portador;
	}

	public function getPortadorByNome ($nomePortador) {

		$portador =  $this->em->getRepository('AppBundle:Portador')->find($nomePortador);
		return $portador;
	}
}
