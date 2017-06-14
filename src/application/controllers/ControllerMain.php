<?php

namespace Application\controllers;

use Application\core\Controller;
use Application\models\ModelMembers;
use Application\core\View;

class ControllerMain extends Controller
{
	public function __construct()
    {
        $this->model = new ModelMembers();
        $this->view = new View();
    }
	function actionIndex()
	{
		$data = $this->model->getCount();
		$this->view->generate('ViewMain.php', 'ViewTemplate.php',
		[
		    'first' => array_key_exists('id', $_SESSION),
		    'data' => $data
        ]);
	}
}