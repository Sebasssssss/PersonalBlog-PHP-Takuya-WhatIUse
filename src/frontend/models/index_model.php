<?php
	
	require_once("generic_model.php");

	class index_model extends generic_model{

	public function listCards(){

		$sql = "SELECT * from cards WHERE state = 1 ORDER BY `categorie` DESC";
		
		$list = $this->getList($sql);
		return $list;

	}

}
?>
