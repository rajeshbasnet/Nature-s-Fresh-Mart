<?php
    $connection = oci_pconnect("RAJES", "David_123", "localhost/xe");
    if (!$connection) {
      $error =oci_error();
      echo "string";
      trigger_error('Could not connect to database: '.$error['message'],E_USER_ERROR);
     } echo "";

?>