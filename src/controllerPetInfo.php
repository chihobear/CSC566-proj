<?php

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();	   

echo json_encode($theDB ->getPetInfo());

?>  