<?php


class generic_model{


    public function getList($sql, $arrayData = array()){
		/*
			$sql = Es la consulta contra la base de datos
			$arrayDatos = son los datos que van por parametro en la consulta
		*/
		include("config/configs.php");

		$host 		  = $BDMYSQL['host'];
		$dbName 	  = $BDMYSQL['dbName'];
		$user 		  = $BDMYSQL['user'];
		$password 	= $BDMYSQL['password'];
		$options    = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_CASE => PDO::CASE_NATURAL,
			PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
		];

		$objConection = new PDO("mysql:localhost=".$host.";dbname=".$dbName."",$user,$password,$options);

		$getReady = $objConection->prepare($sql);
		$getReady->execute($arrayData);
		$list = $getReady->fetchAll();

		return $list;

	} 

	public function getData($sql, $arrayData = array()){
		/*
			$sql = Es la consulta contra la base de datos
			$arrayDatos = son los datos que van por parametro en la consulta
		*/
		include("config/configs.php");

		$host 		= $BDMYSQL['host'];
		$dbName 	= $BDMYSQL['dbName'];
		$user 		= $BDMYSQL['user'];
		$password 	= $BDMYSQL['password'];
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_CASE => PDO::CASE_NATURAL,
			PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
		];

		$objConection = new PDO("mysql:localhost=".$host.";dbname=".$dbName."",$user,$password,$options);

		try{

			$getReady = $objConection->prepare($sql);
			$return = $getReady->execute($arrayData);

		}catch(Exception $e){
			// En caso que de error imprimimos en pantalla el error 
			// Y retornamos un false
			print_r($e->getMessage());				
			$return = false;

		}catch(PDOException $ePDO){
			// En caso que de error imprimimos en pantalla el error 
			// Y retornamos un false
			print_r($ePDO->getMessage());
			$return = false;
		}
		
		return $return;

	} 

	public function uploadImage($rFile,$rHeight,$rWidth){
	
		//$rArchivo = $_FILE[(Y el name de input file)];
		$file = $rFile;
		$routeTMP = $rFile['tmp_name'];

		if($rFile['tmp_name'] == ""){
			return false;
		}	

		$type =  $rFile['type'];
		switch ($type){
				case "image/png":
					$type = "png";
					break;
				case "image/jpeg":
					$type = "jpg";
					break;
				case "image/jpg":
					$type = "jpg";
					break;
				case "image/PNG":
					$type = "PNG";
					break;
				case "image/JPEG":
					$type = "jpg";
					break;
				case "image/JPG":
					$type = "JPG";
					break;						
			}
		$name			= uniqid().".".$type;
		$routeTMPlocal 	= "tmp/".$name;
		$routeFinal		= "files/images/".$name;

		if(copy($routeTMP, $routeTMPlocal)){

			//Cargo en memoria la imagen que quiero redimensionar
			// antes de cargar verifico si la imagen es png  
			if($type == "png" || $type == "PNG"){
				$original_image = imagecreatefrompng($routeTMPlocal);
			}else{
				$original_image = imagecreatefromjpeg($routeTMPlocal);
			}
			//Obtengo el ancho de la imagen que cargue
			$original_width = imagesx($original_image);
			//Obtengo el alto de la imagen que cargue
			$original_height = imagesy($original_image);
			//Va el alto y el ancho con que el que queda la foto
			$final_height = $rHeight;
			$final_width = $rWidth;
			//Creo una imagen vacia, con el alto y el ancho que tendrla imagen redimensionada
			$image_withNewSize = imagecreatetruecolor($final_width, $final_height);
			//Copio la imagen original con las nuevas dimensiones a la imagen en blanco que creamos en la linea anterior
			imagecopyresampled($image_withNewSize, $original_image, 0, 0, 0, 0, $final_width, $final_height, $original_width, $original_height);
			//Guardo la imagen ya redimensionada
			// antes de guardar la imagen valido si la misma es png
			if($type == "png" || $type == "PNG"){
				imagepng($image_withNewSize,$routeFinal);
			}else{
				imagejpeg($image_withNewSize,$routeFinal);
			}
			//Libero recursos, destruyendo las imagenes que estaban en memoria
			imagedestroy($original_image);
			imagedestroy($image_withNewSize);
			//Borramos la primera imagen subida al servidor
			unlink($routeTMPlocal );
			return $name; 

		}else{
			return false;
		}
	}

}

?>
