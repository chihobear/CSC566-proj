<?php

class DatabaseAdaptor {
    private $DB; // The instance variable used in every method
    // Connect to an existing data based named 'first'
    public function __construct() {
        $dataBase =
        'mysql:dbname=pet;charset=utf8;host=127.0.0.1';
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
        return $stmt->fetchAll ( PDO::FETCH_ASSOC );
		
    }
    

    public function insertUser( $firstName,$lastName,
                   $phone, $email, $userName, $pwd){
				
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
			(first_name,last_name,phone,email,username,password)
			VALUES ('"
			  .$firstName."', '".$lastName."', '".
				$phone."', '".$email."', '".$userName."', '"
				.$pwd."');");
			$stmt->execute();
			return true;
		}


    }
	

}
?>