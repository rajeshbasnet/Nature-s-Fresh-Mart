<?php

    // include_once '../../Connection.php';

    if (isset($_POST['btnOffer'])) {
        if(!empty($_POST['offer_disc']) && !empty($_POST['offer_desc'])){
            $offer_id = $_POST['offer_id'];
            $offer_disc = $_POST['offer_disc'];
            $offer_desc = $_POST['offer_desc'];

            $query2 = "UPDATE ECOMMERCE.offer SET description = '$offer_desc', percentage = '$offer_disc' WHERE offer_id = '$offer_id'";
            oci_error();
            $result = oci_parse($connection, $query2);
            $up = oci_execute($result, OCI_DEFAULT);
            // TODO : Button position
            if($up){
                oci_commit($connection);
                echo "<button type='button' class='btn btn-outline-success btn-lg mt-4' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>&nbsp;&nbsp;&nbsp;The offer has been updated</button>";
            }else{
                echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: Could not execute query</button>";
            }
        } else{
            echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: no field(s) can be left empty</button>";
        }
    }
?>
