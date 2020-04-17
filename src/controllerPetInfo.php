<?php

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();	   

echo json_encode($pet_info = $theDB ->getPetInfo());
//print_r($pet_info);
//$pet_img = $theDB ->displayPetImage($pet_info[1][7], $pet_info[1][1]);
//print_r($pet_img);

//echo json_encode(array_merge($pet_info, $pet_img));
?>  