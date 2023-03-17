<?php
include_once "db_conn.php";


if(isset($_POST['p_item_id'])){
    $table = "products";
    
    $p_item_id  = $_POST['p_item_id'];
    $p_item_name = $_POST['p_item_name'];
    $p_item_price = $_POST['p_item_price'];
    
    
    $fields = array( 'item_name' => $p_item_name
                   , 'item_price' => $p_item_price
                   );
    $filter = array( 'item_id' => $p_item_id );
    
   
   if( update($conn, $table, $fields, $filter )){
       header("location: index.php?update_status=success");
       exit();
   }
    else{
        header("location: index.php?update_status=failed");
        exit();
    }
 }
?>