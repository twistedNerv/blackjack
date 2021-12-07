<?php

class tableModel extends model {

    public $id;
    public $table_name;
    public $decks_num;
    public $dealer_stops_17;
    public $double_bet;
    public $split;
    public $surender;
    public $insurance;
    public $ratio;
    public $min_bet;
    public $max_bet;
    public $color;
    public $active_table;

    public function __construct() {
        parent::__construct();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getTable_name() {
        return $this->table_name;
    }

    public function setTable_name($table_name) {
        $this->table_name = $table_name;
        return $this;
    }
    
    public function getDecks_num() {
        return $this->decks_num;
    }

    public function setDecks_num($decks_num) {
        $this->decks_num = $decks_num;
        return $this;
    }

    public function getDealer_stops_17() {
        return $this->dealer_stops_17;
    }

    public function setDealer_stops_17($dealer_stops_17) {
        $this->dealer_stops_17 = $dealer_stops_17;
        return $this;
    }

    public function getDouble_bet() {
        return $this->double_bet;
    }

    public function setDouble_bet($double_bet) {
        $this->double_bet = $double_bet;
        return $this;
    }

    public function getSplit() {
        return $this->split;
    }

    public function setSplit($split) {
        $this->split = $split;
        return $this;
    }

    public function getSurender() {
        return $this->surender;
    }

    public function setSurender($surender) {
        $this->surender = $surender;
        return $this;
    }

    public function getInsurance() {
        return $this->insurance;
    }

    public function setInsurance($insurance) {
        $this->insurance = $insurance;
        return $this;
    }

    public function getRatio() {
        return $this->ratio;
    }

    public function setRatio($ratio) {
        $this->ratio = $ratio;
        return $this;
    }

    public function getMin_bet() {
        return $this->min_bet;
    }

    public function setMin_bet($min_bet) {
        $this->min_bet = $min_bet;
        return $this;
    }

    public function getMax_bet() {
        return $this->max_bet;
    }

    public function setMax_bet($max_bet) {
        $this->max_bet = $max_bet;
        return $this;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
        return $this;
    }

    public function getActive_table() {
        return $this->active_table;
    }

    public function setActive_table($active_table) {
        $this->active_table = $active_table;
        return $this;
    }

    public function getOneBy($ident, $value) {
        $result = $this->db->getOneByParam($ident, $value, 'table');
        $this->fillTable($result);
        return $this;
    }

    public function getAll($orderBy = null, $order = null, $limit = null) {
        return $this->db->getAll($orderBy, $order, $limit, 'table');
    }

    public function getAllBy($ident, $identVal, $orderBy = null, $orderDirection = 'ASC', $limit = null) {
        return $this->db->getAllByParam($ident, $identVal, 'table', $orderBy, $orderDirection, $limit);
    }

    public function flush($sqlDump = 0) {
        $this->db->flush($this, 'table', $sqlDump);
    }

    public function remove() {
        $this->db->delete($this, 'table');
    }

    public function fillTable($data) {
        $columns = $this->db->getTableColumns('table');
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

}
