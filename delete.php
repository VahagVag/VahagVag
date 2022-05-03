<?php
include_once 'database.php';
use Database\DB;

$database = new DB();
$database->connect();
if(!empty($_REQUEST)){
    $product_id = $_POST['product'];
    if(isset($product_id)){
        $sql = "DELETE FROM pruducts WHERE id=".$product_id;
        $result = $database->query($sql);
        if ($result){
            header("Location: welcome.php");
        }else{
            echo 'Something went wrong';
        }
    }
}