
<?php

//Creating functions to be called whenever needed in any page
function getConnection() {
    //Connect to Database
    $connection = oci_connect("RAJES", "David_123", "//localhost/xe");

    if (!$connection) {
        $m = oci_error();
        echo $m['message'], "\n";
        exit; }

    return $connection;

}

