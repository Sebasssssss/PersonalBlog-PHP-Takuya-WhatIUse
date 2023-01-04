<?php

require_once("models/generic_model.php");

class aboutme_model extends generic_model{

		protected $name;

		protected $description;

		protected $profilePicture;

		protected $dateOfBirth;

		protected $location;

	protected $id;

		public function getName(){
		  return $this->name;
		}

		public function getDescription(){
		  return $this->description;
		}

		public function getProfilePicture(){
		  return $this->profilePicture;
		}

		public function getDateOfBirth(){
		  return $this->dateOfBirth;
		}

		public function getLocation(){
		  return $this->location;
		}

		public function getId(){
		  return $this->id;
		}


		public function constructor($data = array()){

		$this->name				= $data['name'];
		$this->description		= $data['description'];
		$this->profilePicture	= $data['profilePicture'];
		$this->dateOfBirth		= $data['dateOfBirth'];
		$this->location			= $data['location'];
		$this->id				= isset($data['id'])?$data['id']:"";

		}


		public function load($id){

      $sql = "SELECT * FROM aboutme WHERE id = :id";
      $arraySQL = array("id" => $id);
      $list = $this->getList($sql, $arraySQL);

      if(isset($list[0]['id'])){

        $this->name				= $list[0]['name'];
        $this->description		= $list[0]['description'];	
        $this->profilePicture	= $list[0]['profilePicture'];
        $this->dateOfBirth		= $list[0]['dateOfBirth'];
        $this->location			= $list[0]['location'];
        $this->id				= $list[0]['id'];
      }

		}  

	public function profileData(){
		
		$sql = "SELECT name,
					description,
					dateOfBirth,
					profilePicture,
					location,
					id 
				FROM aboutme";
		
		$list = $this->getList($sql);
		return $list;

	}

	public function edit(){


		if($this->profilePicture != ""){
			$sql = "UPDATE aboutme SET
					name 			= :name,
					description 	= :description,
					dateOfBirth 	= :dateOfBirth,
					location 		= :location,
					profilePicture	= :profilePicture
				WHERE id = :id;";
			$arraySQL = array(
				"name" 				=> $this->name,
				"description" 		=> $this->description,
				"dateOfBirth" 		=> $this->dateOfBirth,
				"location" 			=> $this->location,
				"profilePicture"	=> $this->profilePicture,
				"id" 				=> $this->id,
			);

		}else{
			$sql = "UPDATE aboutme SET
					name 			= :name,
					description 	= :description,
					dateOfBirth 	= :dateOfBirth,
					location 		= :location
				WHERE id = :id;";
			$arraySQL = array(
				"name" 				=> $this->name,
				"description" 		=> $this->description,
				"dateOfBirth" 		=> $this->dateOfBirth,
				"location" 			=> $this->location,
				"id" 				=> $this->id,
			);

		}
		$return = $this->getData($sql, $arraySQL);

		if($return){
			$arrayReturn['code'] = "Succes";
			$arrayReturn['message'] = "Your profile has been edited succesfuly!";
		}else{
			$arrayReturn['code'] = "Error";
			$arrayReturn['message'] = "Oops! There was an error editing your profile";
		}
		return $arrayReturn;	
	}  

  public function listCardsAboutMe(){

      $sql = "SELECT * FROM cards WHERE categorie = 1";

      $list = $this->getList($sql);
      return $list;
  }



}

?>
