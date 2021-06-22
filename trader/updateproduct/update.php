<?php

    include 'Connection.php';

    if (isset($_POST['btnUpdate '])) {
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

        $query2 = "UPDATE product SET product_name = '$UPproductName', item_price = '$UPproductPrice', quantity_in_stock = '$UPinstock', availablility = '$UPavailability', min_order = '$UPminOrder', max_order = '$UPmaxOrder', allergy_info = '$UPallergyInfo', product_info = '$UPproductDesc', product_image = '$UPproductImageName', fk_offer_id = '$productName'  WHERE product_id = $productId";

        if(mysqli_query($connection, $query2)){
            echo "<button type='button' class='btn btn-outline-success btn-lg' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>The product has been updated</button>";
        }else{
            echo "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>ERROR: Could not execute query</button>";
        }

        header("Location: http://localhost/Nature-s-Fresh-Mart/trader/displayproduct/displayProduct.php");
    }
?>
