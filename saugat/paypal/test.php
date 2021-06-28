<?php

    include 'Connection.php';
    //check if connection was successful
    if ($connection) {
        $query = "SELECT max(order_id) from orders";
        $qte = oci_parse($connection, $query);
        oci_execute($qte);

        while (($row = oci_fetch_assoc($qte))){
            // var_dump($row) ;
            foreach ($row as $res) {
                echo $res;
            }
        }
}
?>
