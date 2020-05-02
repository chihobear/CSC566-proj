<?php

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();	   
$user = $_POST["user"];
echo json_encode($pet_info = $theDB ->getPetInfo($user));
?>  