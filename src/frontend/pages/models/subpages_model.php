<?php
	
require_once("generic_model.php");

class subpages_model extends generic_model{

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

public function load($id){

		$sql = "SELECT * FROM cards WHERE id = :id";
		$arraySQL = array("id" => $id);
		$list = $this->getList($sql, $arraySQL);

		if(isset($list[0]['id'])){

			$this->subtitle	    = $list[0]['subtitle'];
			$this->cardName		  = $list[0]['cardName'];
			$this->description	= $list[0]['description'];	
			$this->image1		    = $list[0]['image1'];
			$this->image2		    = $list[0]['image2'];
			$this->image3		    = $list[0]['image3'];
			$this->categorie	  = $list[0]['categorie'];
			$this->id			      = $list[0]['id'];
		}

}

	public function listEquipment(){

			$sql = "SELECT * from cards WHERE categorie = 3 ORDER BY `id` DESC";
			
			$list = $this->getList($sql);
			return $list;

	}

	public function listWork(){

			$sql = "SELECT * from cards WHERE categorie = 2 ORDER BY `id` DESC";
			
			$list = $this->getList($sql);
			return $list;

	}

  public function listCardsAboutMe(){

      $sql = "SELECT * FROM cards WHERE categorie = 1";

      $list = $this->getList($sql);
      return $list;
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

}
?>
