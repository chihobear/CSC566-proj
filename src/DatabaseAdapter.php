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
    
	public function insertPet($petName,$petType,
                   $petBreed, $petAge,$petGender, $petInfo, $petImage, $petOwner){
		$stmt = $this->DB->prepare("INSERT INTO pet_info 
			(id,name,type,breed,age,gender,info,image,owner)
			VALUES ('"
			  .$petName."', '".$petType."', '". $petBreed."', 
			  '". $petAge."','".$petGender."', '".$petInfo."', 
			  '".$petImage."' ,'".$petOwner."' );");
			$stmt->execute();
			
			//test return image data;
			
					 
	}

    public function insertUser( $firstName,$lastName,
                   $phone, $email, $userName, $pwd, $adopter, $sender){

		$usernameCheck = $this->DB->prepare("SELECT * FROM profile WHERE 
			username ='".$userName."';");
		$emailCheck = $this->DB->prepare("SELECT * FROM profile WHERE 
			email ='".$email."';");
		$phoneCheck = $this->DB->prepare("SELECT * FROM profile WHERE 
			phone ='".$phone."';");
			
		$phoneCheck->execute();
		$emailCheck->execute();
		$usernameCheck->execute();
		
		$valid = true;
		$message = "";
		
		if ($usernameCheck ->rowCount() != 0)
		{
			//echo "Username already exist ".PHP_EOL."";
			$valid = false;
			$message .="1";
		}
		if ($emailCheck ->rowCount() != 0)
		{
			//echo "Email already in use ".PHP_EOL."";
			$valid = false;
			$message .="2";
		}
		

		if ($phoneCheck ->rowCount() != 0)
		{
			//echo "Phone already in use ".PHP_EOL."";
			$valid = false;
			$message .="3";
		}
		
		if ($valid == true)
		{			
			$stmt = $this->DB->prepare("INSERT INTO profile 
			(first_name,last_name,phone,email,username,password,adopter,sender)
			VALUES ('"
			  .$firstName."', '".$lastName."', '".
				$phone."', '".$email."', '".$userName."', '"
				.$pwd."' ,'".$adopter."', '".$sender."' );");
			$stmt->execute();
			//echo "login sucessful";
			$message .="0";
		}
		return $message;

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
	/*
	public function getStates(){
		$states = $this->DB->prepare("SELECT stateName FROM states WHERE countryID = 'USA'; ");
		$result = $states->execute();
		$result = $states->fetchAll();
		return $result;
	}
*/
	public function getPetInfo(){
	    $states = $this->DB->prepare("SELECT name,type,breed,age,gender,info,image,owner FROM pet_info");
	    $result = $states->execute();
	    $result = $states->fetchAll();
	    return $result;
	}
}
?>