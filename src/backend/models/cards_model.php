<?php

require_once("models/generic_model.php");

class cards_model extends generic_model{

		protected $subtitle;

		protected $cardName;

		protected $description;

		protected $categorie;

		protected $image1;

		protected $image2;

		protected $image3;

		protected $id;

	public function getSubtitle(){
		return $this->subtitle;
	}

	public function getCardName(){
		return $this->cardName;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getCategorie(){
		return $this->categorie;
	}

	public function getImage1(){
		return $this->image1;
	}

	public function getImage2(){
		return $this->image2;
	}

	public function getImage3(){
		return $this->image3;
	}

	public function getId(){
		return $this->id;
	}


	public function constructor($data = array()){

		$this->subtitle 		    = $data['subtitle'];
		$this->cardName 	  = $data['cardName'];
		$this->description 	= $data['description'];
		$this->categorie 	  = $data['categorie'];
		$this->image1		    = $data['image1'];
		$this->image2		    = $data['image2'];
		$this->image3		    = $data['image3'];
		$this->id 		      = isset($data['id'])?$data['id']:"";

	}


	public function load($id){

		$sql = "SELECT * FROM cards WHERE id = :id";
		$arraySQL = array("id" => $id);
		$list = $this->getList($sql, $arraySQL);

		if(isset($list[0]['id'])){

			$this->subtitle		    = $list[0]['subtitle'];
			$this->cardName		  = $list[0]['cardName'];
			$this->description	= $list[0]['description'];	
			$this->image1		    = $list[0]['image1'];
			$this->image2		    = $list[0]['image2'];
			$this->image3		    = $list[0]['image3'];
			$this->categorie	  = $list[0]['categorie'];
			$this->id			      = $list[0]['id'];	
		}

	}


	public function addNewCard(){

		$sql = "INSERT INTO cards SET

			subtitle 		= :subtitle,
			cardName 	  = :cardName,
			description	= :description,
			categorie 	= :categorie,
			image1 	    = :image1,
			image2 	    = :image2,
			image3		  = :image3";

			$arraySQL = array(
			"subtitle" 	  => $this->subtitle,
			"cardName" 	  => $this->cardName,
			"description"	=> $this->description,
			"categorie" 	=> $this->categorie,
			"image1" 	    => $this->image1,
			"image2" 	    => $this->image2,
			"image3" 	    => $this->image3,
			);

		$return = $this->getData($sql, $arraySQL);

		if($return){
			$arrayReturn['code'] = "Succes";
			$arrayReturn['message'] = "The data has been uploaded correctly!";
		}else{
			$arrayReturn['code'] = "Error";
			$arrayReturn['message'] = "There was an error uploading the data";
		}
		return $arrayReturn;

	}

	public function edit(){

		if($this->image1 != "" || $this->image2 != "" || $this->image3 != ""){

      if($this->image1 != "" && $this->image2 != "" && $this->image3 != ""){

        $sql = "UPDATE cards SET
                subtitle 			= :subtitle,
                cardName 	    = :cardName,
                description 	= :description,
                categorie 	  = :categorie,
                image1        = :image1,
                image2        = :image2,
                image3        = :image3
              WHERE id = :id;";

        $arraySQL = array(
          "subtitle" 		=> $this->subtitle,
          "cardName" 		=> $this->cardName,
          "description" => $this->description,
          "categorie"		=> $this->categorie,
          "image1" 		  => $this->image1,
          "image2" 		  => $this->image2,
          "image3" 		  => $this->image3,
          "id" 				  => $this->id,
        );

      }else{

        if($this->image1 != ""){
          $sql = "UPDATE cards SET
                    subtitle 			= :subtitle,
                    cardName 	    = :cardName,
                    description 	= :description,
                    categorie 	  = :categorie,
                    image1        = :image1
                  WHERE id = :id;";

          $arraySQL = array(
            "subtitle" 		=> $this->subtitle,
            "cardName" 		=> $this->cardName,
            "description" => $this->description,
            "categorie"		=> $this->categorie,
            "image1" 		  => $this->image1,
            "id" 				  => $this->id,
          );
        }

        if($this->image2 != ""){
          $sql = "UPDATE cards SET
                    subtitle 			= :subtitle,
                    cardName 	    = :cardName,
                    description 	= :description,
                    categorie 	  = :categorie,
                    image2        = :image2
                  WHERE id = :id;";

          $arraySQL = array(
            "subtitle" 		=> $this->subtitle,
            "cardName" 		=> $this->cardName,
            "description" => $this->description,
            "categorie"		=> $this->categorie,
            "image2" 		  => $this->image2,
            "id" 				  => $this->id,
          );
        }

        if($this->image3 != ""){
          $sql = "UPDATE cards SET
                    subtitle 			= :subtitle,
                    cardName 	    = :cardName,
                    description 	= :description,
                    categorie 	  = :categorie,
                    image3        = :image3
                  WHERE id = :id;";

          $arraySQL = array(
            "subtitle" 		=> $this->subtitle,
            "cardName" 		=> $this->cardName,
            "description" => $this->description,
            "categorie"		=> $this->categorie,
            "image3" 		  => $this->image3,
            "id" 				  => $this->id,
          );
        }

      }
				
    }else{
      $sql = "UPDATE cards SET
                subtitle 			= :subtitle,
                cardName 	    = :cardName,
                description 	= :description,
                categorie 	  = :categorie
              WHERE id = :id;";

			$arraySQL = array(
				"subtitle" 		=> $this->subtitle,
				"cardName" 		=> $this->cardName,
				"description" => $this->description,
				"categorie"		=> $this->categorie,
				"id" 				  => $this->id,
      );
    }

		$return = $this->getData($sql, $arraySQL);

		if($return){
			$arrayReturn['code'] = "Succes";
			$arrayReturn['message'] = "The data has been edited succesfuly!";
		}else{
			$arrayReturn['code'] = "Error";
			$arrayReturn['message'] = "Oops! There was an error editing the data";
		}
		return $arrayReturn;	
}


	public function listCards($filters = array()){

		$sql = "SELECT 	car.subtitle,
						car.cardName,
						car.description,
						car.image1,
						car.image2,
						car.image3,
						c.name,
						car.id
				FROM cards car
						INNER JOIN categories c ON c.id = car.categorie
						WHERE car.state = 1 ORDER BY id DESC";


		if(isset($filters['search']) && $filters['search'] != ""){

				$sql .= " AND cardName LIKE ('%".$filters['search']."%')";
			}
		
		$list = $this->getList($sql);
		return $list;

  }

  public function listBackendCards(){

		$sql = "SELECT * from cards WHERE state = 1 ORDER BY `categorie` DESC";
		
		$list = $this->getList($sql);
		return $list;

	}


	public function delete(){

			$sql = "UPDATE cards SET state = 0 WHERE id = :id";
			$arraySQL = array("id" => $this->id);
			$return = $this->getData($sql, $arraySQL);

			if($return){
				$arrayReturn['code'] = "Succes";
				$arrayReturn['message'] = "The data has been deleted correctly!";
			}else{
				$arrayReturn['code'] = "Error";
				$arrayReturn['message'] = "There was an error deleting the data!";
			}
			return $arrayReturn;

	}

}

?>
