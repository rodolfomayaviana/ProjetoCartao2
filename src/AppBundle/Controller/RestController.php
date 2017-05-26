<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Form;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Liip\HelloBundle\Document\Article;
use Liip\HelloBundle\Form\ArticleType;
use Liip\HelloBundle\Response as HelloResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class DefaultController extends Controller
{
    public function buscaGastoesAction(Request $request)
    {


    } // "busca_gastoes" [GET] /busca
}
