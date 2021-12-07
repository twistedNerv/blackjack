<?php

class tableController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function indexAction($id = 0) {
        $tableModel = $this->loadModel('table');
        $tableObj = $tableModel->getAll();
        $this->view->assign('vars', get_class_vars('tableModel'));
        $this->view->assign('items', $tableObj);
        $this->view->render("table/index");
    }

    public function updateAction($id = 0) {
        $this->tools->checkPageRights(4);
        $tableModel = $this->loadModel("table");
        if ($id != 0) {
            $tableModel->getOneBy("id", $id);
        }
        if ($this->tools->getPost("action") == "handletable") {
            $tableModel->setTable_name($this->tools->getPost("table-table_name"));
            $tableModel->setDecks_num($this->tools->getPost("table-decks_num"));
            $tableModel->setDealer_stops_17($this->tools->getPost("table-dealer_stops_17"));
            $tableModel->setDouble_bet($this->tools->getPost("table-double_bet"));
            $tableModel->setSplit($this->tools->getPost("table-split"));
            $tableModel->setSurender($this->tools->getPost("table-surender"));
            $tableModel->setInsurance($this->tools->getPost("table-insurance"));
            $tableModel->setRatio($this->tools->getPost("table-ratio"));
            $tableModel->setMin_bet($this->tools->getPost("table-min_bet"));
            $tableModel->setMax_bet($this->tools->getPost("table-max_bet"));
            $tableModel->setColor($this->tools->getPost("table-color"));
            $tableModel->setActive_table($this->tools->getPost("table-active_table"));
            $tableModel->flush();
            $action = ($id != 0) ? "Table element with id: $id updated successfully." : "table successfully added.";
            $this->tools->log("table", $action);
            //if ($id == 0)
                //$this->tools->redirect(URL . "table/update");
        }
        $allItems = $tableModel->getAll();
        //var_dump($allItems);
        $this->view->assign("items", $allItems);
        $this->view->assign("selectedTable", $tableModel);
        $this->view->render("table/update");
    }

    public function removeAction($id) {
        if ($id) {
            $tableModel = $this->loadModel("table");
            $tableModel->getOneBy("id", $id);
            $tableModel->remove();
            $this->tools->log("table", "Table element with id: $id removed.");
            $this->tools->redirect(URL . "table/update");
        } else {
            echo "No table element id selected!";
        }
    }

}
