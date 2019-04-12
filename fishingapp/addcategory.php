<?php
 require_once '../../db_functions.php';
 $db=new DB_Functions();

 
 $response = array();
 if (isset($_POST['name'])&&isset($_POST['imgPath']) )
 {
     $name=$_POST['name'];
	$imgPath=$_POST['imgPath'];
         //Create new category
         $result=$db->insertNewCategory($name,$imgPath);
         if($result){
             
             echo json_encode("Add category success! ");
         } else {
             
             echo json_encode("Error while write to database");
         }

 } else {
     echo json_encode("Required parameter (phone) is missing");
 }
?>
