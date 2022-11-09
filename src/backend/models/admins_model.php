
<?php

	require_once("models/generic_model.php");

	class admins_model extends generic_model{
		
		protected $id;

		protected $name;

		protected $mail;

		protected $password;

		protected $state;
	
		public function getId(){

			return $this->id;
		}

		public function getName(){

			return $this->name;
		}

		public function getMail(){

			return $this->mail;
		}

		public function constructor($data = array()){

			$this->id 		  = $data['id'];
			$this->name 	  = $data['name'];
			$this->mail 	  = $data['mail'];
			$this->password = md5($data['password']);

		}

		public function load($id){
			

			$sql = "SELECT * FROM admins WHERE id = :id";
			$arrayData = array("id" => $id);
			$list = $this->getList($sql, $arrayData);

			if(isset($list[0])){
				$this->id 		= $list[0]['id'];
				$this->name 	= $list[0]['name'];
				$this->mail 	= $list[0]['mail'];
				$this->state 	= $list[0]['state'];	
			}

		}

		public function login($name, $password){

			$sql = "SELECT * FROM admins 
							WHERE name = :name
							AND password = :password";

			$nameLowercase = strtolower($name);
			$passwordMD5 = md5($password);
			$arraySQL = array("name" =>$nameLowercase, "password" =>$passwordMD5);

			$admins = $this->getList($sql, $arraySQL);

			if(isset($admins[0])){
				return true;
			}
			return false;

		}

	} 

?>

