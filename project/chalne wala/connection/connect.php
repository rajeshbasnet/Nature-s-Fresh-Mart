<?php
function getConnection() {
    //Connect to Database
    $connection = oci_connect("ECOMMERCE", "vileroze", "//localhost/xe");

    if (!$connection) {
        $m = oci_error();
        echo $m['message'], "\n";
        exit; }

    return $connection;

}


