<?php

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();
$sub_str = $_GET["value"];
echo json_encode($theDB ->getValue($sub_str)); 
?>  