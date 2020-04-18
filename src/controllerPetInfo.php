<?php

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();	   

echo json_encode($pet_info = $theDB ->getPetInfo());
?>  