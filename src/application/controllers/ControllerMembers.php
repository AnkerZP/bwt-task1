<?php

namespace Application\controllers;

use Application\core\Controller;
use Application\core\View;
use Application\models\ModelMembers;

class ControllerMembers extends Controller
{
    public function __construct()
    {
        $this->model = new ModelMembers();
        $this->view = new View();
    }

    public function actionIndex()
    {
        $data = $this->model->getData();
        $this->view->generate('ViewMembers.php', 'ViewTemplate.php', $data);
    }

    public function actionSave()
    {
        $rez = $this->model->setData();
        echo $rez;
    }        

    public function actionUpdate()
    {
        $data = $this->model->setUpdate();
        echo $data;
    }

    public function actionPhoto()
    {
        $data = $this->model->setPhoto();
        echo $data;
    }

    public function actionValid()
    {
        $data = $this->model->isValid();
        echo $data;
    }
}