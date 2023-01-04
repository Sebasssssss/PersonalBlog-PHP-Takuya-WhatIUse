<?php

require_once("models/generic_model.php");

class categories_model extends generic_model{

		public $name;

		public $id;

		public function getName(){
    	  return $this->name;
		}

		public function getId(){
	      return $this->id;
		}

		public function constructor($data = array()){

      $this->name 		= $data['name'];
      $this->id 		= isset($data['id'])?$data['id']:"";

		}

    public function load($id){

      $sql = "SELECT * FROM categories WHERE id = :id";
      $arrayData = array("id" => $id);
      $list = $this->getList($sql, $arrayData);

      if(isset($list[0])){

        $this->name		= $list[0]['name'];
        $this->id			= $list[0]['id'];	
      }

    }

    public function listSelect(){

      $sql = "SELECT id, name
            FROM categories 
            WHERE state = 1 ";

      $list = $this->getList($sql);
      return $list;

    }

	}

?>
