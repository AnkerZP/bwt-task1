<?php

namespace Application\controllers;

use Application\core\Controller;

class Controller404 extends Controller
{

    function actionIndex()
    {
        $this->view->generate('View404.php', 'ViewTemplate.php');
    }

}