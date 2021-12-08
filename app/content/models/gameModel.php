<?php

class gameModel extends model {

	public $id;
	public $table_id;
	public $user_id;
	public $rounds;
	public $bs_errors;
	public $start_dt;
	public $end_dt;
	public $balance_start;
	public $balance_end;
	public $roi;
	public $active;


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

	public function getTable_id() {
		return $this->table_id;
	}

	public function setTable_id($table_id) {
		$this->table_id = $table_id;
		return $this;
	}

	public function getUser_id() {
		return $this->user_id;
	}

	public function setUser_id($user_id) {
		$this->user_id = $user_id;
		return $this;
	}

	public function getRounds() {
		return $this->rounds;
	}

	public function setRounds($rounds) {
		$this->rounds = $rounds;
		return $this;
	}

	public function getBs_errors() {
		return $this->bs_errors;
	}

	public function setBs_errors($bs_errors) {
		$this->bs_errors = $bs_errors;
		return $this;
	}

	public function getStart_dt() {
		return $this->start_dt;
	}

	public function setStart_dt($start_dt) {
		$this->start_dt = $start_dt;
		return $this;
	}

	public function getEnd_dt() {
		return $this->end_dt;
	}

	public function setEnd_dt($end_dt) {
		$this->end_dt = $end_dt;
		return $this;
	}

	public function getBalance_start() {
		return $this->balance_start;
	}

	public function setBalance_start($balance_start) {
		$this->balance_start = $balance_start;
		return $this;
	}

	public function getBalance_end() {
		return $this->balance_end;
	}

	public function setBalance_end($balance_end) {
		$this->balance_end = $balance_end;
		return $this;
	}

	public function getRoi() {
		return $this->roi;
	}

	public function setRoi($roi) {
		$this->roi = $roi;
		return $this;
	}

	public function getActive() {
		return $this->active;
	}

	public function setActive($active) {
		$this->active = $active;
		return $this;
	}

	public function getOneBy($ident, $value) {
		$result = $this->db->getOneByParam($ident, $value, 'game');
		$this->fillGame($result);
		return $this;
	}

	public function getAll($orderBy = null, $order = null, $limit = null) {
		return $this->db->getAll($orderBy, $order, $limit, 'game');
	}

public function getAllBy($ident, $identVal, $orderBy = null, $orderDirection = 'ASC', $limit=null) {
return $this->db->getAllByParam($ident, $identVal, 'game', $orderBy, $orderDirection, $limit);
	}

	public function flush($sqlDump=0) {
		$this->db->flush($this, 'game', $sqlDump);
	}

	public function remove() {
		$this->db->delete($this, 'game');
	}

	public function fillGame($data) {
		$columns = $this->db->getTableColumns('game');
		foreach($data as $key => $value) {
			$this->$key = $value;
		}
		return $this;
	}
}