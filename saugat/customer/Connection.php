<?php
    $connection = oci_connect('ECOMMERCE' , 'vileroze', '//localhost/xe');
    if (!$connection) {
        $m = oci_error();
        echo $m['message'], "\n";
        exit;
    } else{
        echo "";
    }
?>
