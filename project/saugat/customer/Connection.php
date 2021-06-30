<?php
    $connection = oci_connect('RAJES' , 'David_123', '//localhost/xe');
    if (!$connection) {
        $m = oci_error();
        echo $m['message'], "\n";
        exit;
    } else{
        echo "";
    }
?>