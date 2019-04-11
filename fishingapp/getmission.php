<?php
 require_once 'db_functions.php';
 $db=new DB_Functions();


 $response = array();
 if (isset($_POST['trasuaid']))
 {
     $trasuaid=$_POST['trasuaid'];
     $mission=$db->getMissionById($trasuaid);
    echo json_encode($mission);

 } else {
     $response["error_msg"]="Required parameter (trasuaid) is missing";
     echo json_encode($response);
 }
?>