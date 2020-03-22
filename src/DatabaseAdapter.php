<?php

class DatabaseAdaptor {
    private $DB; // The instance variable used in every method
    // Connect to an existing data based named 'first'
    public function __construct() {
        $dataBase =
        'mysql:dbname=PetAdoption;charset=utf8;host=127.0.0.1';
        $user =
        'root';
        $password =
        ''; // Empty string with XAMPP install
        try {
            $this->DB = new PDO ( $dataBase, $user, $password );
            $this->DB->setAttribute ( PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION );
        } catch ( PDOException $e ) {
            echo ('Error establishing Connection');
            exit ();
        }
    } // . . . continued
    
    public function userLogin($loginUsername,$loginPwd ){

        $stmt = $this->DB->prepare("SELECT * FROM profile WHERE 
			username ='".$loginUsername."' AND

			password = '" .$loginPwd."';");
        $check = $stmt->execute();
		//$num_rows = $check->num_rows;

			//return $num_rows;
			$check = $stmt->fetchAll ( PDO::FETCH_ASSOC );
			/*
		if(!empty($check)) 
		{
			return 1;
		}
		if(empty($check)) 
		{
			return 0;
		}*/
		
       return $check;
		
    }
    

    public function insertUser( $firstName,$lastName,
                   $phone, $email, $userName, $pwd, $adopter, $sender){

		$usernamCheck = $this->DB->prepare("SELECT * FROM profile WHERE 
			username ='".$userName."';");
			
		if ($usernamCheck ->rowCount() != 0)
		{
			echo "Username already exist";
			return false;
		}
		else
		{			
			$stmt = $this->DB->prepare("INSERT INTO profile 
			(first_name,last_name,phone,email,username,password,adopter,sender)
			VALUES ('"
			  .$firstName."', '".$lastName."', '".
				$phone."', '".$email."', '".$userName."', '"
				.$pwd."' ,'".$adopter."', '".$sender."' );");
			$stmt->execute();
			return true;
		}


    }

    public function userInfo($user_name){
    	$userInfo = $this->DB->prepare("SELECT first_name, last_name, email, adopter, sender FROM profile WHERE username = '".$user_name."';");
    	$result = $userInfo->execute();
    	$result = $userInfo->fetchAll();
    	return $result;
    }

    public function getLocation($location_str, $state){
    	$location;
    	if($state == ''){
    		$location = $this->DB->prepare("SELECT cityName, stateName FROM cities left join states on cities.stateID = states.stateID WHERE cities.countryID = 'USA' and cities.cityName LIKE '".$location_str."%';");
    	}
    	else{
    		$location = $this->DB->prepare("SELECT cityName, stateName FROM cities left join states on cities.stateID = states.stateID WHERE cities.countryID = 'USA' and states.stateName = '".$state."' and cities.cityName LIKE '".$location_str."%';");
    	}
    	
    	$result = $location->execute();
    	$result = $location->fetchAll();
    	return $result;
    }
	
	public function getStates(){
		$states = $this->DB->prepare("SELECT stateName FROM states WHERE countryID = 'USA'; ");
		$result = $states->execute();
		$result = $states->fetchAll();
		return $result;
	}

}
?>