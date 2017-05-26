<?php

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
Use mysqli;


class DatabaseController extends Controller
{

    private $mysqli;
    protected $container;

    public function  __construct ($container)
   {
      $this->container = $container;
   }

    public function conectaDB()
    {
	$this->mysqli = new mysqli ($this->container->getParameter('database_host') ,
			      $this->container->getParameter('database_user') ,
			      $this->container->getParameter('database_password') ,
			      $this->container->getParameter('database_name'));
	if ($this->mysqli->connect_error) {
	   die('Connect error (' . $this->mysqli->connect_errno . ') '
		. $this->mysqli->connect_Error);
	}
   }

   public function executaSQL($sql)
   {
	$result = $this->mysqli->query($sql);

	if (!$result) {
		echo $this->mysqli->error;
	}

	return $result;
   }
   public function desconectaDB()
   {
	$this->mysqli->close();
   }
}
