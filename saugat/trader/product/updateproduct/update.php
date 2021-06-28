<?php

    include_once '../../Connection.php';

    if (isset($_POST['btnUpdate'])) {
        if(!empty($_POST['up_product-name'])&& !empty($_POST['up_product-price']) && !empty($_POST['up_product-quantity']) && !empty($_POST['up_product-availability']) && !empty($_POST['up_min-order']) && !empty($_POST['up_max-order']) && !empty($_POST['up_product-desc']) ){
            $productId = $_POST['up_product-id'];
            $UPproductName = $_POST['up_product-name'];
            $UPproductPrice = $_POST['up_product-price'];
            $UPinstock = $_POST['up_product-quantity'];
            $UPavailability = $_POST['up_product-availability'];
            $UPminOrder = $_POST['up_min-order'];
            $UPmaxOrder = $_POST['up_max-order'];
            $UPproductDesc = $_POST['up_product-desc'];
            $UPallergyInfo = $_POST['up_product-allergy__info'];
            $UPproductImageName = $_POST['up_product-img'];
            $UPofferId = $_POST['up_fk_offer_id'];

            $query2 = "UPDATE product SET product_name = '$UPproductName', item_price = '$UPproductPrice', quantity_in_stock = '$UPinstock', availablility = '$UPavailability', min_order = '$UPminOrder', max_order = '$UPmaxOrder', allergy_info = '$UPallergyInfo', product_info = '$UPproductDesc', product_image = '$UPproductImageName',  fk_offer_id = '$UPofferId'  WHERE product_id = '$productId'";
            oci_error();
            $result = oci_parse($connection, $query2);
            $up = oci_execute($result, OCI_DEFAULT);
            // TODO : Button position
            if($up){
                oci_commit($connection);
                echo "<button type='button' class='btn btn-outline-success btn-lg mt-4' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>T&nbsp;&nbsp;&nbsp;he product has been updated</button>";
            }else{
                echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: Could not execute query</button>";
            }

        }else{
            echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: no field(s) can be left empty</button>";
        }
    }
?>
