<?php
include_once "db_conn.php";

if(isset($_POST['new_item_name'])){
    $p_item_name=$_POST['new_item_name'];
    $p_item_price=$_POST['new_item_price'];
    
    $table = "products";
    $fields = array('item_name' => $p_item_name
                   , 'item_price' => $p_item_price
                   );
    
    if(insert($conn, $table, $fields) ){
        header("location: index.php?new_record=added");
        exit();
    }  
    else{
        header("location: index.php?new_record=failed");
        exit();
    }
}