<?php
    $connection = oci_pconnect("ECOMMERCE", "vileroze", "localhost/xe");
    if (!$connection) {
      $error =oci_error();
      echo "string";
      trigger_error('Could not connect to database: '.$error['message'],E_USER_ERROR);
     } echo "";

?>
