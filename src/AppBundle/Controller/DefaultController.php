<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Gasto;
use Appbundle\Entity\Portador;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\ORM\Query\ResultSetMapping;
use AppBundle\Controller\GastoController;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="inicio")
     */
    public function inicioAction(Request $request)
    {

	$gastoController = new GastoController($this->getDoctrine()->getEntityManager(), $this->container);
	$gastoes = $gastoController->getGastoes(2016, 01);
        return $this->render('inicio.html.twig');

    }

    /**
     * @Route("/campeoes", name="campeoes")
     */
    public function campeoesAction(Request $request)
    {

        $gastoController = new GastoController($this->getDoctrine()->getEntityManager(), $this->container);
        $orgaoController = new OrgaoController($this->getDoctrine()->getEntityManager(), $this->container);
        $gastoes = $gastoController->getGastoes(2016, 01);
	$cntPaginacao = ($request->query->get('page') - 1) * 10;
	$dados_tabela =  "";
	for ( $i = $cntPaginacao ; $i < ($cntPaginacao + 10) ; $i++) {
		$dados_tabela .= "<tr><td>";
		$dados_tabela .= $gastoes[$i]->getNomePortador();
		$dados_tabela .= "</td><td>";
		$dados_tabela .= $orgaoController->getOrgaoById($gastoes[$i]->getCodigoOrgaoSubordinado())->getNomeDoOrgao();
		$dados_tabela .= "</td><td>";
		$dados_tabela .= $gastoes[$i]->getCodigoOrgaoSubordinado();
		$dados_tabela .= "</td><td>";
		$dados_tabela .= $gastoes[$i]->getValorTransacao();
		$dados_tabela .= "</td></tr>";
	}
        return $this->render('campeoes.html.twig', ['tabela' => $dados_tabela]);

    }

    /**
     * @Route("/orgao", name="orgao")
     */
    public function orgaoAction(Request $request)
    {

        $gastoController = new GastoController($this->getDoctrine()->getEntityManager(), $this->container);
        $gastoes = $gastoController->getGastoes(2016, 01);
        return $this->render('inicio.html.twig');

    }

    /**
     * @Route("/destinatario", name="destinatario")
     */
    public function destinatarioAction(Request $request)
    {

        $gastoController = new GastoController($this->getDoctrine()->getEntityManager(), $this->container);
        $gastoes = $gastoController->getGastoes(2016, 01);
        return $this->render('inicio.html.twig');

    }

    /**
     * @Route("/sacadores", name="sacadores")
     */
    public function sacadoresAction(Request $request)
    {

        $gastoController = new GastoController($this->getDoctrine()->getEntityManager(), $this->container);
        $gastoes = $gastoController->getGastoes(2016, 01);
        return $this->render('inicio.html.twig');

    }

    /**
     * @Route("/portador", name="portador")
     */
    public function portadorAction(Request $request)
    {

        $gastoController = new GastoController($this->getDoctrine()->getEntityManager(), $this->container);
        $gastoes = $gastoController->getGastoes(2016, 01);
        return $this->render('inicio.html.twig');

    }

}
