<?php

    include '../../Connection.php';

    //Gather id from $_GET[]
    $id = $_GET['uID'];

    //Construct DELETE query to remove record where WHERE id provided equals the id in the table
    $query = "UPDATE ECOMMERCE.product SET availablility = 0 WHERE product_id = '$id'";
    $resultD = oci_parse($connection, $query);
    $del = oci_execute($resultD, OCI_DEFAULT);
    if ($del) {
        oci_commit($connection);
        header("Location: http://localhost/Nature-s-Fresh-Mart/trader/displayproduct/displayProduct.php");
    }else{
        echo "bla";
    }
?>
