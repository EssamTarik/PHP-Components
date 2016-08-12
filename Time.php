<?php



class Time
{
	private static $dateTime;

	public function getInstance()
	{
		//singleton pattern to provide only one DateTime instance

		if(self::$dateTime == Null){
			
			//create a new DateTime instance and set timezone
			self::$dateTime = new \DateTime();
			$timeZone = new \DateTimeZone('Africa/Cairo');
			self::$dateTime->setTimeZone($timeZone);
		}
		return self::$dateTime;
	}

	//return date and time as a string
	public static function dateTimeStr($format=Null){
		$dateTime = self::getInstance();
		
		if($format!=Null)
			return $dateTime->format($format);
		
		return $dateTime->format('d/m/Y H:i:s');
	}


	//return date and time as an array
	public static function dateTimeArray(){
		$dateTime = self::getInstance();
		
		$array = array();
		$array['second'] = $dateTime->format('s');
		$array['minute'] = $dateTime->format('i');
		$array['hour'] = $dateTime->format('h');
		$array['24hour'] = $dateTime->format('H');
		$array['day'] = $dateTime->format('d');
		$array['month'] = $dateTime->format('m');
		$array['year'] = $dateTime->format('y');
		$array['year4'] = $dateTime->format('Y');

		return $array;
	}

	//return date only as a string
	public static function dateNow(){
		
		$dateTime = self::getInstance();		
		return $dateTime->format('d/m/Y');

	}

	//return time only as a string
	public static function timeNow(){

		$dateTime = self::getInstance();
		return $dateTime->format('H:i:s');

	}

}

