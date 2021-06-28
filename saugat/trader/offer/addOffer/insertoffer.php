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
                        $query = "INSERT INTO offer (fk_trader_id, percentage, description) VALUES ('$fk_trader_id', '$offerDisc', '$offerDesc')";
                        $qte = oci_parse($connection, $query);
                        //run $query
                        // TODO : Button position
                        if (oci_execute($qte)) {
                            echo "<button type='button' class='btn btn-outline-success btn-lg mt-4' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>&nbsp;&nbsp;&nbsp;Offer detail inserted</button>";
                        }else{
                            echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: Could not execute query</button>";
                        }
                    }else{
                        echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: check db connection</button>";
                    }
                }else $pnameerror = "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: Product name cannot be a number</button>";
        } else {
            echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: no field(s) can be left empty</button>";
        }
    }

?>
