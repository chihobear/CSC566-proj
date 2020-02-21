<?php

class DatabaseAdaptor {
    private $DB; // The instance variable used in every method
    // Connect to an existing data based named 'first'
    public function __construct() {
        $dataBase =
        'mysql:dbname=test;charset=utf8;host=127.0.0.1';
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
        $stmt = $this->DB->prepare("Select * from test where 
			username =".$loginUsername." and 
			password = " .$loginPwd.";");
        $stmt->execute();
        return $stmt->fetchAll ( PDO::FETCH_ASSOC );
    }
    
    public function insertUser($id, $first_name,$last_name,
                   $phone, $email, $username, $pwd){
        $stmt = $this->DB->prepare("INSERT INTO test VALUES ('".
            $id."', '".$first_name."', '".$last_name."', '".
            $phone."', '".$email."', '".$username."', '"
            .$pwd."');");
        $stmt->execute();
        return $stmt->fetchAll ( PDO::FETCH_ASSOC );
    }
}
?>