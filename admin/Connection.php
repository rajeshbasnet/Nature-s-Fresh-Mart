<?php
    $connection = oci_connect('SYSTEM' , 'vileroze', '//localhost/xe');
    if (!$connection) {
        $m = oci_error();
        echo $m['message'], "\n";
        exit;
    } else{
        echo "";
    }
?>
