<?php

    //Gather from $_POST[]all the data submitted and store in variables
    if (isset($_POST['insertP'])) {
        if(!empty($_POST['product-name'])&& !empty($_POST['product-price']) && !empty($_POST['product-quantity']) && !empty($_POST['product-availability']) && !empty($_POST['min-order']) && !empty($_POST['max-order']) && !empty($_POST['product-desc']) && !empty($_POST['product-img'])){
            if (filter_var($_POST['product-price'], FILTER_VALIDATE_FLOAT)) {
                if(!is_numeric($_POST['product-name'])){

                    $productName = $_POST['product-name'];
                    $productPrice = $_POST['product-price'];
                    $instock = $_POST['product-quantity'];
                    $availability = $_POST['product-availability'];
                    $minOrder = $_POST['min-order'];
                    $maxOrder = $_POST['max-order'];
                    $productDesc = $_POST['product-desc'];
                    $allergyInfo = $_POST['product-allergy__info'];
                    $productImageName = $_POST['product-img'];
                    $fk_shop_id = 80;
                    $fk_offer_id = NULL;
                    $status = 1;

                    //Construct INSERT query using variables holding data gathered
                    if ($connection) {
                        $query = "INSERT INTO ECOMMERCE.product (fk_shop_id, product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image, fk_offer_id, status)
                                VALUES ('$fk_shop_id', '$productName', '$productPrice', '$instock', '$availability', '$minOrder', '$maxOrder', '$allergyInfo', '$productDesc', '$productImageName', '$fk_offer_id', '$status')";
                        $qte = oci_parse($connection, $query);
                        //run $query
                        if (oci_execute($qte)) {
                            echo "<button type='button' class='btn btn-outline-success btn-lg' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>Product detail inserted</button>";
                        }else{
                            echo "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>ERROR: Could not execute query</button>";
                        }
                    }else{
                        echo "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>ERROR: check db connection</button>";
                    }
                }else $pnameerror = "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>ERROR: Product name cannot be a number</button>";
            } else {
                $priceerror = "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>ERROR: Price must be a floating number in the format '9.99'</button>";
            }
        } else {
            echo "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>ERROR: no field(s) can be left empty</button>";
        }
    }

?>
