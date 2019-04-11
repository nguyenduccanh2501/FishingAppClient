<?php
 require_once 'db_functions.php';
 $db=new DB_Functions();

 /*
  * Endpoint: http://<domain>/fishingapp/register.php
  * Method: POST
  * Params: phone,name,birthday,address
  * Result: JSON
  */
 $response = array();
 if (isset($_POST['phone']))
 {
     $phone=$_POST['phone'];

         //Create new user
         $user=$db->getBanner($phone);
         if($user){
             $response["phone"]=$user["Phone"];
             echo json_encode($response);
         } else {
             $response["error_msg"]="User does not exist";
             echo json_encode($response);
         }

 } else {
     $response["error_msg"] = "Required parameter (phone) is missing";
     echo json_encode($response);
 }
?>