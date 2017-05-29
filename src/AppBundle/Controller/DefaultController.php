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
	$paginas = count($gastoes) / 10;
	for ( $i = $cntPaginacao ; $i < ($cntPaginacao + 10) ; $i++) {
		$dados_tabela .= "<tr><td>";
		$dados_tabela .= $gastoes[$i]->getNomePortador();
		$dados_tabela .= "</td><td>";
		$dados_tabela .= $orgaoController->getOrgaoById($gastoes[$i]->getCodigoOrgaoSubordinado())->getNomeDoOrgao();
		$dados_tabela .= "</td><td>";
		$dados_tabela .= $gastoes[$i]->getCodigoUnidadeGestora();
		$dados_tabela .= "</td><td>";
		$dados_tabela .= $gastoes[$i]->getValorTransacao();
		$dados_tabela .= "</td></tr>";
	}
        return $this->render('campeoes.html.twig', ['tabela' => $dados_tabela, 'paginas' => $request->query->get('page') - 1]);

    }

    /**
     * @Route("/orgao", name="orgao")
     */
    public function orgaoAction(Request $request)
    {
        $gastoController = new GastoController($this->getDoctrine()->getEntityManager(), $this->container);
        $orgaoController = new OrgaoController($this->getDoctrine()->getEntityManager(), $this->container);
	$unidadeController = new UnidadeController($this->getDoctrine()->getEntityManager(), $this->container);
	$favorecidoController = new FavorecidoController($this->getDoctrine()->getEntityManager(), $this->container);

        $gastosPorOrgao = $gastoController->getGastosPorOrgao(47205);
        $cntPaginacao = ($request->query->get('page') - 1) * 10;
        $dados_tabela =  "";
        for ( $i = $cntPaginacao ; $i < ($cntPaginacao + 10) ; $i++) {
                $dados_tabela .= "<tr><td>";
                $dados_tabela .= $orgaoController->getOrgaoById($gastosPorOrgao[$i]->getCodigoOrgaoSuperior())->getNomeDoOrgao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $orgaoController->getOrgaoById($gastosPorOrgao[$i]->getCodigoOrgaoSubordinado())->getNomeDoOrgao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $unidadeController->getUnidadeById($gastosPorOrgao[$i]->getCodigoUnidadeGestora())
		->getNomeDaUnidadeGestora();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorOrgao[$i]->getAnoTransacao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorOrgao[$i]->getMesTransacao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorOrgao[$i]->getNomeTransacao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorOrgao[$i]->getNomePortador();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $favorecidoController->getFavorecidoById($gastosPorOrgao[$i]->getCodigoFavorecido())->getNomeDoFavorecido();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorOrgao[$i]->getDataTransacao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorOrgao[$i]->getValorTransacao();
                $dados_tabela .= "</td></tr>";
        }
        return $this->render('orgao.html.twig', ['tabela' => $dados_tabela]);

    }

    /**
     * @Route("/destinatario", name="destinatario")
     */
    public function destinatarioAction(Request $request)
    {

        $gastoController = new GastoController($this->getDoctrine()->getEntityManager(), $this->container);
        $orgaoController = new OrgaoController($this->getDoctrine()->getEntityManager(), $this->container);
        $unidadeController = new UnidadeController($this->getDoctrine()->getEntityManager(), $this->container);
        $favorecidoController = new FavorecidoController($this->getDoctrine()->getEntityManager(), $this->container);

        $gastosPorFavorecido = $gastoController->getGastosPorFavorecido(60570793000106);
        $cntPaginacao = ($request->query->get('page') - 1) * 10;
        $dados_tabela =  "";
        for ( $i = $cntPaginacao ; $i < ($cntPaginacao + 10) ; $i++) {
                $dados_tabela .= "<tr><td>";
                $dados_tabela .= $orgaoController->getOrgaoById($gastosPorFavorecido[$i]->getCodigoOrgaoSuperior())->getNomeDoOrgao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $orgaoController->getOrgaoById($gastosPorFavorecido[$i]->getCodigoOrgaoSubordinado())->getNomeDoOrgao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $unidadeController->getUnidadeById($gastosPorFavorecido[$i]->getCodigoUnidadeGestora())
                ->getNomeDaUnidadeGestora();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorFavorecido[$i]->getAnoTransacao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorFavorecido[$i]->getMesTransacao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorFavorecido[$i]->getNomeTransacao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorFavorecido[$i]->getNomePortador();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $favorecidoController->getFavorecidoById($gastosPorFavorecido[$i]->getCodigoFavorecido())->getNomeDoFavorecido();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorFavorecido[$i]->getDataTransacao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorFavorecido[$i]->getValorTransacao();
                $dados_tabela .= "</td></tr>";
        }
        return $this->render('destinatario.html.twig', ['tabela' => $dados_tabela]);


    }

    /**
     * @Route("/sacadores", name="sacadores")
     */
    public function sacadoresAction(Request $request)
    {

        $gastoController = new GastoController($this->getDoctrine()->getEntityManager(), $this->container);
        $orgaoController = new OrgaoController($this->getDoctrine()->getEntityManager(), $this->container);
        $sacadores = $gastoController->getSacadores(2016, 01);
        $cntPaginacao = ($request->query->get('page') - 1) * 10;
        $dados_tabela =  "";
        for ( $i = $cntPaginacao ; $i < ($cntPaginacao + 10) ; $i++) {
                $dados_tabela .= "<tr><td>";
                $dados_tabela .= $sacadores[$i]->getNomePortador();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $orgaoController->getOrgaoById($sacadores[$i]->getCodigoOrgaoSubordinado())->getNomeDoOrgao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $sacadores[$i]->getCodigoUnidadeGestora();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $sacadores[$i]->getValorTransacao();
                $dados_tabela .= "</td></tr>";
        }
        return $this->render('sacadores.html.twig', ['tabela' => $dados_tabela, 'paginas' => $request->query->get('page') - 1]);


    }

    /**
     * @Route("/portador", name="portador")
     */
    public function portadorAction(Request $request)
    {

        $gastoController = new GastoController($this->getDoctrine()->getEntityManager(), $this->container);
        $orgaoController = new OrgaoController($this->getDoctrine()->getEntityManager(), $this->container);
        $unidadeController = new UnidadeController($this->getDoctrine()->getEntityManager(), $this->container);
        $favorecidoController = new FavorecidoController($this->getDoctrine()->getEntityManager(), $this->container);

        $gastosPorPortador = $gastoController->getGastosPorPortador("ABILIO M PINTO");
        $cntPaginacao = ($request->query->get('page') - 1) * 10;
        $dados_tabela =  "";
        for ( $i = $cntPaginacao ; $i < ($cntPaginacao + 10) ; $i++) {
                $dados_tabela .= "<tr><td>";
                $dados_tabela .= $orgaoController->getOrgaoById($gastosPorPortador[$i]->getCodigoOrgaoSuperior())->getNomeDoOrgao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $orgaoController->getOrgaoById($gastosPorPortador[$i]->getCodigoOrgaoSubordinado())->getNomeDoOrgao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $unidadeController->getUnidadeById($gastosPorPortador[$i]->getCodigoUnidadeGestora())
		->getNomeDaUnidadeGestora();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorPortador[$i]->getAnoTransacao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorPortador[$i]->getMesTransacao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorPortador[$i]->getNomeTransacao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorPortador[$i]->getNomePortador();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $favorecidoController->getFavorecidoById($gastosPorPortador[$i]->getCodigoFavorecido())->getNomeDoFavorecido();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorPortador[$i]->getDataTransacao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorPortador[$i]->getValorTransacao();
                $dados_tabela .= "</td></tr>";
        }
        return $this->render('portador.html.twig', ['tabela' => $dados_tabela]);


    }

}
