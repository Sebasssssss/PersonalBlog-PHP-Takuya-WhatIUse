<?php

require_once("models/generic_model.php");

class categories_model extends generic_model{

		public $name;

		public $id;

		public $totalInList = 3;

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


		public function addCategorie(){

			$sql = "INSERT INTO categories SET name = :name;";

			$arraySQL = array("name" 	=> $this->name);

			$answer = $this->getData($sql, $arraySQL);

			if($answer){
				$arrayAnswer['code'] = "Succes";
				$arrayAnswer['message'] = "The data has been uploaded correctly!";
			}else{
				$arrayAnswer['code'] = "Error";
				$arrayAnswer['message'] = "Error uploading the data";
			}
			return $arrayAnswer;


		}



		public function listCategories($filters = array()){

				$sql = "SELECT * FROM categories WHERE state = 1;";

				if(isset($filters['search']) && $filters['search'] != ""){

				$sql .= " AND (name LIKE ('%".$filters['search']."%')";
				}


				if(isset($filters['page']) && $filters['page'] != ""){
					$page = $filters['page'] * $this->totalInList;
					$sql .= " LIMIT ".$page.",".$this->totalInList."";
				}else{
					$sql .= " LIMIT 0,".$this->totalInList;
				}
				$list = $this->getList($sql);
					return $list;

		}

		public function delete(){

				$sql = "UPDATE categories SET state = 0 WHERE id = :id";
				$arraySQL = array("id" => $this->id);
				$answer = $this->getData($sql, $arraySQL);

				if($answer){
					$arrayAnswer['code'] = "Succes";
					$arrayAnswer['message'] = "The data has been deleted correctly!";
				}else{
					$arrayAnswer['code'] = "Error";
					$arrayAnswer['message'] = "Error deleting the data";
				}
				return $arrayAnswer;

		}

    public function listSelect(){

          $sql = "SELECT id, name
                FROM categories 
                WHERE state = 1 ";

          $list = $this->getList($sql);
          return $list;

        }


		public function maximumPages($filters = array()){

			$sql = "SELECT count(*) total FROM categories
			WHERE state = 1";

			if(isset($filters['search']) && $filters['search'] != ""){

				$sql .= " AND title LIKE ('%".$filters['search']."%')";
			}


			$list = $this->getList($sql);

			$totalRegisters = $list[0]['total'];
			$totalPages = ceil($totalRegisters/$this->totalInList);
			
			return $totalPages;

		}


	}



?>
