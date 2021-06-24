<?php

    include '../Connection.php';

    //Gather id from $_GET[]
    $id = $_GET['uID'];

    //Construct DELETE query to remove record where WHERE id provided equals the id in the table
    $query = "UPDATE ECOMMERCE.product SET availablility = 0 WHERE product_id = '$id'";
    $resultD=oci_parse($connection, $query);

    if (oci_execute($resultD)) {
        echo "<button type='button' class='btn btn-outline-success btn-lg' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-check-circle' style='color:green;'></i>The product has been deleted</button>";
    }else{
        echo "<button type='button' class='btn btn-outline-success btn-lg' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>ERROR: Query could not be executed</button>";
    }

    header("Location: http://localhost/Nature-s-Fresh-Mart/trader/displayproduct/displayProduct.php");

?>
