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
	$gastoes = $gastoController->getGastoes();
        return $this->render('inicio.html.twig');

    }

    /**
     * @Route("/campeoes", name="campeoes")
     */
    public function campeoesAction(Request $request)
    {

        $gastoController = new GastoController($this->getDoctrine()->getEntityManager(), $this->container);
        $orgaoController = new OrgaoController($this->getDoctrine()->getEntityManager(), $this->container);
        $gastoes = $gastoController->getGastoes();
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
        return $this->render('campeoes.html.twig', ['tabela' => $dados_tabela, 'paginas' => $paginas ,
						    'atual' => $request->query->get('page')]);

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

        $gastosPorOrgao = $gastoController->getGastosPorOrgao();
        $cntPaginacao = ($request->query->get('page') - 1) * 10;
        $dados_tabela =  "";
	$paginas = count($gastosPorOrgao) / 10;

        for ( $i = $cntPaginacao ; $i < ($cntPaginacao + 10) ; $i++) {
                $dados_tabela .= "<tr><td>";
                $dados_tabela .= $orgaoController->getOrgaoById($gastosPorOrgao[$i]->getCodigoOrgaoSuperior())->getNomeDoOrgao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $orgaoController->getOrgaoById($gastosPorOrgao[$i]->getCodigoOrgaoSubordinado())->getNomeDoOrgao();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorOrgao[$i]->getCodigoUnidadeGestora();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorOrgao[$i]->getValorTransacao();
                $dados_tabela .= "</td></tr>";
        }
        return $this->render('orgao.html.twig', ['tabela' => $dados_tabela , 'paginas' => $paginas ,
                                                    'atual' => $request->query->get('page')]);

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

        $gastosPorFavorecido = $gastoController->getGastosPorFavorecido();
        $cntPaginacao = ($request->query->get('page') - 1) * 10;
        $dados_tabela =  "";
        $paginas = count($gastosPorFavorecido) / 10;

	for ( $i = $cntPaginacao ; $i < ($cntPaginacao + 10) ; $i++) {
                $dados_tabela .= "<tr><td>";

		switch ($gastosPorFavorecido[$i]->getCodigoFavorecido()) {
			case 1:
               			$dados_tabela .= " ";
                		$dados_tabela .= "</td><td>";
                		$dados_tabela .= "SAQUES EM ESPECIE";
				break;
                        case 2:
                                $dados_tabela .= " ";
                		$dados_tabela .= "</td><td>";
		                $dados_tabela .= "FAVORECIDO NAO IDENTIFICADO";
                                break;
                        default:
                                $dados_tabela .= $gastosPorFavorecido[$i]->getCodigoFavorecido();
                		$dados_tabela .= "</td><td>";
		                $dados_tabela .= $favorecidoController->getFavorecidoById($gastosPorFavorecido[$i]->getCodigoFavorecido())->getNomeDoFavorecido();
				break;
		}

                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorFavorecido[$i]->getCodigoUnidadeGestora();
                $dados_tabela .= "</td><td>";
                $dados_tabela .= $gastosPorFavorecido[$i]->getValorTransacao();
                $dados_tabela .= "</td></tr>";
        }
        return $this->render('destinatario.html.twig', ['tabela' => $dados_tabela , 'paginas' => $paginas ,
                                                    'atual' => $request->query->get('page')]);


    }

    /**
     * @Route("/sacadores", name="sacadores")
     */
    public function sacadoresAction(Request $request)
    {

        $gastoController = new GastoController($this->getDoctrine()->getEntityManager(), $this->container);
        $orgaoController = new OrgaoController($this->getDoctrine()->getEntityManager(), $this->container);
        $sacadores = $gastoController->getSacadores();
        $cntPaginacao = ($request->query->get('page') - 1) * 10;
        $dados_tabela =  "";
        $paginas = count($sacadores) / 10;

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
        return $this->render('sacadores.html.twig', ['tabela' => $dados_tabela, 'paginas' => $paginas ,
                                                    'atual' => $request->query->get('page')]);


    }

}
