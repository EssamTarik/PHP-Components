<?php
echo "<html>";
echo "<meta charset='utf8'>";
class DB
{
	private static $pdo;

	public function getInstance()
	{
		//singleton pattern to provide only one PDO instance

		if(self::$pdo == Null){
			
			self::$pdo = new \PDO('mysql:host=localhost;dbname=training;charset=utf8', 'training', 'training');
		}
		return self::$pdo;
	}

	//get all data from a specific table
	public static function getAll($table){
		$pdo = self::getInstance();

		$statement = $pdo->prepare("select * from ".$table);
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		//return false if no results are found
		if(count($results)>0)
			return $results;
		return false;

	}

	//get a specific id from table
	public static function get($table, $id){
		$pdo = self::getInstance();

		$statement = $pdo->prepare("select * from ".$table." where id=?");
		$statement->execute(array($id));
		$results = $statement->fetchAll(PDO::FETCH_ASSOC)[0];
		
		//return false if no results are found
		if(count($results)>0)
			return $results;
		return false;

	}

	//insert into a specific table
	public static function insert($table="", $data=array()){
		$pdo = self::getInstance();

		$values = array();
		$sql = 'insert into '.$table.' set ';
		foreach($data as $key=>$value){
			$sql=$sql.$key.' = ? ,';
			$values[]=$value;
		}

		//replace the last comma with semicolons
		$sql = substr($sql, 0, strlen($sql)-1);
		

		$statement = $pdo->prepare($sql);
		$statement->execute($values);
	}


	//delete a row by id
	public static function delete($table, $id){
		$pdo = self::getInstance();

		$statement = $pdo->prepare("delete from ".$table." where id=?");
		$statement->execute(array($id));
	}

	//delete all from a table
	public static function deleteAll($table){
		$pdo = self::getInstance();

		$statement = $pdo->prepare("truncate ".$table);
		$statement->execute();
	}


	//search a table
	public static function search($table="", $data=array()){
		$pdo = self::getInstance();
		$sql = "select * from $table where ";
		$values = array();

		foreach($data as $key=>$value){
			$sql = $sql."$key = ? AND ";
			$values[]=$value;
		}

		$sql = substr($sql, 0, strlen($sql)-4);

		// echo $sql;

		$statement = $pdo->prepare($sql);
		$statement->execute($values);

		$results = $statement->fetchAll(PDO::FETCH_ASSOC);
		//return false if no results are found
		if(count($results)>0)
			return $results;
		return false;
	}
}
