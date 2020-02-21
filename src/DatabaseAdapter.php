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
<<<<<<< HEAD
        $stmt = $this->DB->prepare("Select * from profile where 
			username =".$loginUsername." and 
=======
        $stmt = $this->DB->prepare("Select * from profile where
			username =".$loginUsername." and
>>>>>>> 14e77f8828205dc50df3a230faf9043d07e91f02
			password = " .$loginPwd.";");
        $stmt->execute();
        return $stmt->fetchAll ( PDO::FETCH_ASSOC );
    }
    
<<<<<<< HEAD
    public function insertUser( $firstName,$lastName,
                   $phone, $email, $userName, $pwd){
					   
        $stmt = $this->DB->prepare("INSERT INTO profile 
		(first_name,last_name,phone,email,username,password)
		
		VALUES ('"
          .$firstName."', '".$lastName."', '".
            $phone."', '".$email."', '".$userName."', '"
            .$pwd."');");
        $stmt->execute();
		
        return 0;
=======
    public function insertUser($first_name,$last_name,
        $phone, $email, $username, $pwd){
            $stmt = $this->DB->prepare("SELECT id FROM profile where username=".$username);
            $stmt->execute();
            if($stmt->fetchALL()!=NULL){
                echo "Username already exits! Please try another username!!!\n";
                return 0;
            }
            $stmt = $this->DB->prepare("INSERT INTO profile (first_name, last_name,phone,
            email, username, password) VALUES ('"
                .$first_name."', '".$last_name."', '".
                $phone."', '".$email."', '".$username."', '"
                .$pwd."');");
            $stmt->execute();
            return 1;
>>>>>>> 14e77f8828205dc50df3a230faf9043d07e91f02
    }
}
?>