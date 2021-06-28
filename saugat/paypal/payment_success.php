<?php

include 'Connection.php';

    $basketID = $_GET['basketID'];
    $collectionID = $_GET['collectionID'];

    //check if connection was successful
    if ($connection) {
        $query1 = "INSERT INTO orders (order_id, fk_basket_id, fk_collection_slot_id)
                VALUES (null, '$basketID', '$collectionID')";
        $qp1 = oci_parse($connection, $query);

        if (oci_execute($qp1)) {
            echo "<button type='button' class='btn btn-outline-success btn-lg mt-4' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>&nbsp;&nbsp;&nbsp;Orders table ma insert bhayo/button>";
        }else{
            echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: Could not execute query</button>";
        }
    }else{
        echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: check db connection</button>";
    }
        // $query2 = "SELECT max(order_id) from orders";
        // $qp2 = oci_parse($connection, $query);
        // oci_execute($qp2);

        // while (($row = oci_fetch_assoc($qp2))){
        //     // var_dump($row) ;
        //     foreach ($row as $res) {
        //         $query4 = "INSERT INTO payment (transaction_id, fk_order_id, payment_date)
        //                             VALUES (null, $res, to_char(SYSDATE,'DD-MON-YYYY HH24:MI:SS')) FROM dual";
        //         $qp4 = oci_parse($connection, $query);

        //         if (oci_execute($qp4)) {
        //             echo "<button type='button' class='btn btn-outline-success btn-lg mt-4' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>&nbsp;&nbsp;&nbsp;Payment table ma insert bhayo/button>";
        //         }else{
        //             echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: Could not execute query</button>";
        //         }


        //         $query5 = "SELECT max(transaction_id) from payment";
        //         $qp5 = oci_parse($connection, $query);
        //         oci_execute($qp5);

        //         while (($row = oci_fetch_assoc($qp5))){
        //             foreach ($row as $resu) {
        //                 $query6 = "INSERT INTO invoice (invoice_id, fk_transaction_id, fk_user_id)
        //                     VALUES (null, $resu, to_char(SYSDATE,'DD-MON-YYYY')) FROM dual";
        //                 $qp6 = oci_parse($connection, $query);
        //             }
        //         }



        //         if (oci_execute($qp5)) {
        //             echo "<button type='button' class='btn btn-outline-success btn-lg mt-4' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>&nbsp;&nbsp;&nbsp;Payment table ma insert bhayo/button>";
        //         }else{
        //             echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: Could not execute query</button>";
        //         }

        //         if (oci_execute($qp3)) {
        //             echo "<button type='button' class='btn btn-outline-success btn-lg mt-4' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>&nbsp;&nbsp;&nbsp;Payment table ma insert bhayo/button>";
        //         }else{
        //             echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: Could not execute query</button>";
        //         }
        //     }
        // }

?>
