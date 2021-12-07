<?php

class gameController extends controller {

    function __construct() {
        parent::__construct();
    }
    
    public function mainAction($gametable = null, $game = null) {
        if (!$gametable) {
            $this->tools->redirect(URL . 'game/tables');
        } else {
            $tableModel = $this->loadModel('table');
            $tableObj = $tableModel->getOneBy('id', $gametable);
            
            $this->view->assign('gametable_id', $gametable);
            $this->view->assign('game_id', $game);
            $this->view->render('game/main');
        }
    }
    
    public function tablesAction() {
        $tableModel = $this->loadModel('table');
        $tableObj = $tableModel->getAll();
        $this->view->assign('items', $tableObj);
        $this->view->render("game/tables");
    }
    
}