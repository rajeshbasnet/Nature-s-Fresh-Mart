<?php

    //Gather from $_POST[]all the data submitted and store in variables
    if (isset($_POST['insertOffer'])) {
        if(!empty($_POST['offer_discount'])&& !empty($_POST['offer_desc']) ){
                if(!is_numeric($_POST['offer_desc'])){

                    $offerDisc = $_POST['offer_discount'];
                    $offerDesc = $_POST['offer_desc'];
                    $fk_trader_id = 30;

                    //Construct INSERT query using variables holding data gathered
                    if ($connection) {
                        $query = "INSERT INTO ECOMMERCE.offer (fk_trader_id, percentage, description) VALUES ('$fk_trader_id', '$offerDisc', '$offerDesc')";
                        $qte = oci_parse($connection, $query);
                        //run $query
                        if (oci_execute($qte)) {
                            echo "<button type='button' class='btn btn-outline-success btn-lg' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>Offer detail inserted</button>";
                        }else{
                            echo "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>ERROR: Could not execute query</button>";
                        }
                    }else{
                        echo "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>ERROR: check db connection</button>";
                    }
                }else $pnameerror = "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>ERROR: Product name cannot be a number</button>";
        } else {
            echo "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>ERROR: no field(s) can be left empty</button>";
        }
    }

?>
