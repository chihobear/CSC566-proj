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
		$exist = $this->DB->prepare("SELECT id FROM pet_info where owner = '" . $petOwner . "';");
		$result = $exist->execute();
		$result = $exist->fetchAll();
		//Empty, insert
		if(empty($result)){
			$stmt = $this->DB->prepare("INSERT INTO pet_info 
			(name,type,breed,age,gender,info,owner)
			VALUES ('"
			  .$petName."', '".$petType."', '". $petBreed."', 
			  '". $petAge."','".$petGender."', '".$petInfo."' ,'".$petOwner."' );");
			$stmt->execute();
		}
		//Not empty, modify
		else{
			$stmt = $this->DB->prepare("update pet_info set name='". $petName . "', type='" . $petType . "', breed='" . $petBreed . "', age='" . $petAge . "', gender='" . $petGender . "', info='" . $petInfo . "';");
			$stmt->execute();
		}
					
		
		//Delete all relevant images first
		$delete = $this->DB->prepare("DELETE from pet_image where pet_name = '" . $petName . "' AND pet_owner = '" . $petOwner . "';");
		$delete->execute();

		foreach ($petImage as &$value) {
			$image = $this->DB->prepare("INSERT INTO pet_image (pet_name,pet_owner,image) VALUES (
				'".$petName."', '".$petOwner."', '".$value."'
			);");
			$image ->execute();
		}

					 
	}
	
	public function displayPetOnProfile($user){
		$stmt1 = $this->DB->prepare("SELECT * FROM pet_info WHERE 
			owner = '".$user."'
			;");
		$stmt1->execute();
		$data = $stmt1->fetchAll ( PDO::FETCH_ASSOC );
		
		$images =  [];
		$size = count($data);
		for($x = 0; $x < $size; $x++ ) {
			$petName = $data[$x]["name"];
			$stmt2 = $this->DB->prepare("SELECT image FROM pet_image WHERE 
			pet_name = '".$petName."' AND 
			pet_owner = '".$user."'
			;");
			$stmt2->execute();
			$image = $stmt2->fetchAll ( PDO::FETCH_ASSOC );
			array_push($images,$image);
		}

		/*	
		$stmt2 = $this->DB->prepare("SELECT image FROM pet_image WHERE 
			pet_name = '".$petName."' AND 
			pet_owner = '".$user."'
			;");
    	$stmt2->execute();
		$images = $stmt2->fetchAll ( PDO::FETCH_ASSOC );
		return array($data,$images);
		*/
		return array($data,$images);
	}
	
	public function displayPetImage( $user,$petName ){
		$stmt = $this->DB->prepare("SELECT image FROM pet_image WHERE 
			pet_name = '".$petName."' AND 
			pet_owner = '".$user."'
			;");
    	$stmt->execute();
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
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
    	$userInfo = $this->DB->prepare("SELECT first, last, email, role, age, info, location FROM person_info WHERE username = '".$user_name."';");
    	$result = $userInfo->execute();
    	$result = $userInfo->fetchAll();
    	return $result;
    }

    public function userInfoFromSignUp($user_name){
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
	    $stmt1 = $this->DB->prepare("SELECT * FROM pet_info;");
	    $stmt1->execute();
	    $data = $stmt1->fetchAll ( PDO::FETCH_ASSOC );
	    
	    $images =  [];
	    $size = count($data);
	    for($x = 0; $x < $size; $x++ ) {
	        $petName = $data[$x]["name"];
	        $user = $data[$x]["owner"];
	        $stmt2 = $this->DB->prepare("SELECT image FROM pet_image WHERE
			pet_name = '".$petName."' AND
			pet_owner = '".$user."'
			;");
	        $stmt2->execute();
	        $image = $stmt2->fetchAll ( PDO::FETCH_ASSOC );
	        array_push($images,$image);
	    }
	    
	    /*
	     $stmt2 = $this->DB->prepare("SELECT image FROM pet_image WHERE
	     pet_name = '".$petName."' AND
	     pet_owner = '".$user."'
	     ;");
	     $stmt2->execute();
	     $images = $stmt2->fetchAll ( PDO::FETCH_ASSOC );
	     return array($data,$images);
	     */
	    return array($data,$images);
	}


	public function storePerson($role, $userName, $firstName, $lastName, $age, $location, $contact, $person_intro){
		$exist = $this->DB->prepare("Select username from person_info where username = '" . $userName . "';");
		$result = $exist->execute();
		$result = $exist->fetchAll();
		$flag;
		//insert
		if(empty($result)){
			$flag = True;
		}
		else{
			$flag = False;
		}
		if($flag){
			$person = $this->DB->prepare("INSERT INTO person_info VALUES('" . $firstName . "', '" . $lastName . "', '" . $role . "', " . $age . ", '" . $contact . "', '" . $person_intro . "', 'text', '" . $location . "', '" . $userName . "');");
    		$result = $person->execute();
		}
		else{
			$person = $this->DB->prepare("UPDATE person_info SET age = " . $age . ", email = '" . $contact . "', info = '" . $person_intro . "', location = '" . $location . "' where username = '" . $userName . "';");
			$result = $person->execute();
		}
		
	}

	public function deleteFavorite($user, $owner){
		$stmt = $this->DB->prepare("delete from favorite where username='".$user."' and owner='".$owner."';");
		$stmt->execute();
	}

	public function addFavorite($user, $owner){
		$stmt = $this->DB->prepare("insert into favorite (username, owner) values ('".$user."', '".$owner."');");
		$stmt->execute();
	}
	
	public function chat($from_user,$to_user,$message,$time){
		$stmt = $this->DB->prepare("insert into chat (from_user,to_user,message,time)
					values ('".$from_user."', '".$to_user."','".$message."', '".$time."');");
		$stmt->execute();
		$stmt1 = $this->DB->prepare("SELECT * FROM chat WHERE 
			from_user = '".$from_user."' AND to_user = '".$to_user."'
			;");
		
	}
	
	public function chatDisplay($from_user){
		$stmt = $this->DB->prepare("SELECT * FROM chat WHERE 
			from_user = '".$from_user."' 
			;");
		$stmt->execute();
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
	
	public function startChat($from_user,$to_user){
		$stmt = $this->DB->prepare("INSERT into start_chat(from_user,to_user)
			values ('".$from_user."', '".$to_user."');");
		$stmt->execute();
	}
	
	public function displayStartChat($from_user){
		$stmt = $this->DB->prepare("SELECT * FROM start_chat WHERE 
			from_user = '".$from_user."' 
			;");
		$stmt->execute();
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
}
?>