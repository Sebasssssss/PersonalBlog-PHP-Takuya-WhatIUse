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
	
}

?>
