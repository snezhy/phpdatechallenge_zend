<?php

class IndexController extends Zend_Controller_Param
{

    private $layout;

    public function init()
    {
        $this->layout = Zend_Layout::getMvcInstance();

    }

    public function indexAction()
    {
        $this->view->headScript()->appendFile('../js/dates.js');
    }

    public function getDatesDiffJsonAction() {

        header('Content-Type: application/json');

        if ($_GET['dateOne'] && $_GET['dateTwo']) {
            $dateOne = $_GET['dateOne'];
            $dateTwo = $_GET['dateTwo'];

            $differenceObject = MyDate::diff($dateOne, $dateTwo);

            echo json_encode($differenceObject);
            exit;
        } else {
            echo json_encode(" Please fill in both dates.");
            exit;
        }
    }





}







