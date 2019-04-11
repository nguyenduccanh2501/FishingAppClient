<?php
 require_once 'db_functions.php';
 $db=new DB_Functions();

 /*
  * Endpoint: http://<domain>/fishingapp/submitorder.php
  * Method: POST
  * Params: orderDetail, phone
  * Result: JSON
  */
 $response = array();
 if (isset($_POST['orderDetail'])&&
     isset($_POST['phone']))
 {
     $phone=$_POST['phone'];
     $orderDetail=$_POST['orderDetail'];
     $result = $db->insertNewOrder($orderDetail, $phone);

     if($result)
         echo json_encode("true");
     else
         echo json_encode($this->conn->error);
 } else {
     echo json_encode("Required parameter (phone,orderDetail) is missing");
 }
?>