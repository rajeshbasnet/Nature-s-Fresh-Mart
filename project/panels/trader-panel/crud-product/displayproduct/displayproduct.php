<?php

session_start();

if (isset($_SESSION['trader'])) {
    $user_id = $_SESSION['trader'];

} elseif (isset($_SESSION['admin_as_trader'])) {
    $user_id = $_SESSION['admin_as_trader'];

} else {
    $user_id = "";
}

if (!empty($user_id)) {

    $is_deleted = $_GET['delete'] ??= "";
    $is_disabled = $_GET['disabled'] ??= "";
    $is_enabled = $_GET['enabled'] ??= "";
    $index = $_GET['index'] ??= 1;

    include_once "../../../../connection/connect.php";
    $connection = getConnection();

    include_once "../../../../includes/html-skeleton/skeleton.php";
    include_once "../../../../includes/cdn-links/fontawesome-cdn.php";
    include_once "../../../../includes/cdn-links/bootstrap-cdn.php"; ?>

    <!--External Stylesheet--->
    <link rel="stylesheet" href="displayproduct.css">


    <main>
        <div class="container-fluid">
            <div class="row">
                <?php include '../../trader-side-panel.php' ?>

                <!--display Products Container Column-->
                <div class="col-xl-10 mx-auto p-0">
                    <?php

                    include_once '../../../../assets/trader-types/functions.php';

                    $profile_img = get_profile_image_of_user($user_id, $connection);

                    echo "<div class='user-profile-header position-relative'>";

                    $trader_id = get_user_type_id($user_id, $connection, "TRADERS");
                    $trader_type = get_trader_type_from_traders($trader_id, $connection);

                    echo "<p class='trader-type'>" . strtoupper($trader_type) . "</p>";

                    if (!isset($profile_img)) {
                        $profile_img = "default-image.jpg";
                    }

                    echo "<img src='../../profile/profile-img/" . $profile_img . "' alt='profile-icon' width='40px' height='40px'>";

                    echo "<div class='logout-section position-absolute'>";
                    echo "<p class='p-2'><a href='/website/project/panels/logout.php' class='btn text-light'>logout</a></p>";
                    echo "</div>";

                    echo "</div>";

                    ?>


                    <?php

                    if ($is_deleted == 'success') {
                        echo "<p style='border-width:2px !important; font-size: 1.1rem; font-weight : bold;' class='text-success border p-2 border-success w-50 mx-auto text-center mt-4'><i class='fas fa-check-circle'></i>&nbsp;&nbsp;SUCCESS: PRODUCT REMOVED SUCCESSFULLY</p>";
                    }

                    if ($is_disabled == "success") {
                        echo "<p style='border-width:2px !important; font-size: 1.1rem; font-weight : bold;' class='text-success border p-2 border-success w-50 mx-auto text-center mt-4'><i class='fas fa-check-circle'></i>&nbsp;&nbsp;SUCCESS: PRODUCT DISABLED SUCCESSFULLY</p>";


                    } elseif ($is_disabled == "unsuccess") {
                        echo "<p style='border-width:2px !important; font-size: 1.1rem; font-weight : bold;' class='text-danger border p-2 border-danger w-50 mx-auto text-center mt-4'><i class='fas fa-times-circle'></i>&nbsp;&nbsp;ERROR: CANNOT DISABLE PRODUCT. TRY-AGAIN</p>";
                    }

                    if ($is_enabled == "success") {
                        echo "<p style='border-width:2px !important; font-size: 1.1rem; font-weight : bold;' class='text-success border p-2 border-success w-50 mx-auto text-center mt-4'><i class='fas fa-check-circle'></i>&nbsp;&nbsp;SUCCESS: PRODUCT ENABLED SUCCESSFULLY</p>";

                    } elseif ($is_enabled == "unsuccess") {
                        echo "<p style='border-width:2px !important; font-size: 1.1rem; font-weight : bold;' class='text-danger border p-2 border-danger w-50 mx-auto text-center mt-4'><i class='fas fa-times-circle'></i>&nbsp;&nbsp;ERROR: CANNOT ENABLE PRODUCT. TRY-AGAIN</p>";
                    }

                    $trader_id = get_user_type_id($user_id, $connection, "TRADERS");
                    $trader_type = get_trader_type_from_traders($trader_id, $connection);
                    $total_product = count_all_products_of_trader($trader_type, $connection);

                    $type = $_GET['type'] ??= "";

                    $max_items_in_row = 3;
                    $row_limit = ceil(intval($total_product) / $max_items_in_row);

                    if($type == 'next' && isset($_GET['min_id'])) {
                        ++$index;
                        $min_product_id = $_GET['min_id'];
                        $max_product_id = $min_product_id + $max_items_in_row;

                    }elseif($type == 'previous' && isset($_GET['min_id'])) {
                        --$index;
                        $min_product_id = $_GET['min_id'] - $max_items_in_row;
                        $max_product_id = $_GET['min_id'];
                    }else {

                        $min_product_id = find_min_product_id_of_products_from_trader($trader_type, $connection);
                        $max_product_id = $min_product_id + $max_items_in_row;
                    }


                    //In next phase min product id is max product id so query string max-product-id
                    $result = fetch_all_products_of_trader_with_limit($min_product_id, $max_product_id, $trader_type, $connection);
                    ?>

                    <div class="table-container">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Quantity in stock</th>
                            <th>Allergy info</th>
                            <th>Availability</th>
                            <th>Max order</th>
                            <th>Min order</th>
                            <th>Offer %</th>
                            <th class="text-center">Action</th>
                            </thead>


                            <tbody>

                            <?php

                            while ($rows = oci_fetch_assoc($result)) { ?>

                                <tr>
                                    <td><?php echo $rows['PRODUCT_NAME'] ?></td>
                                    <td>
                                        <img src="../../../../assets/trader-types/<?php echo $trader_type . "/images/products/"; ?><?php echo $rows['PRODUCT_IMAGE'] ?>"
                                             alt="product-image"></td>

                                    <?php

                                    if(isset($rows['FK_OFFER_ID'])) {
                                        $fetch_discounted_price = fetch_discouted_price_from_products($rows['FK_OFFER_ID'], $rows['ITEM_PRICE'], $connection);
                                    }else {
                                        $fetch_discounted_price['total_price_after_discount'] = $rows['ITEM_PRICE'];
                                    }?>

                                    <td>£<?php echo number_format($fetch_discounted_price['total_price_after_discount'], '2', '.'); ?></td>
                                    <td class="product-info"><?php echo $rows['PRODUCT_INFO'] ?></td>
                                    <td><?php echo $rows['QUANTITY_IN_STOCK'] ?></td>
                                    <td class="allergy-info"><?php echo $rows['ALLERGY_INFO'] ?></td>
                                    <td><?php echo $rows['AVAILABLILITY'] ?></td>
                                    <td><?php echo $rows['MAX_ORDER'] ?></td>
                                    <td><?php echo $rows['MIN_ORDER'] ?></td>
                                    <td><?php echo $rows['FK_OFFER_ID'] ?></td>

                                    <?php if (isset($_SESSION['trader'])) {

                                        if($rows['STATUS'] == 1) { ?>

                                            <td class="action">
                                                <a href="http://localhost/website/project/panels/trader-panel/crud-product/deleteproduct/deleteproduct.php?id=<?php echo $rows['PRODUCT_ID']; ?>">Delete</a> |
                                                <a href="http://localhost/website/project/panels/trader-panel/crud-product/updateproduct/updateproduct.php?id=<?php echo $rows['PRODUCT_ID']; ?>">Update</a>
                                            </td>

                                        <?php } else { ?>

                                            <td class="action">
                                                <a href="http://localhost/website/project/panels/trader-panel/crud-product/deleteproduct/deleteproduct.php?id=<?php echo $rows['PRODUCT_ID']; ?>">Delete</a> |
                                                <span style="">Disabled</span>
                                            </td>

                                    <?php  }?>

                                    <?php } elseif (isset($_SESSION['admin_as_trader'])) { ?>

                                        <td class="action">

                                            <?php if (intval($rows['STATUS']) == 1) { ?>

                                                <a href="http://localhost/website/project/panels/trader-panel/crud-product/manageproduct/disableproduct.php?id=<?php echo $rows['PRODUCT_ID']; ?>">Disable</a>

                                            <?php } elseif (intval($rows['STATUS']) == 0) { ?>
                                                <a href="http://localhost/website/project/panels/trader-panel/crud-product/manageproduct/enableproduct.php?id=<?php echo $rows['PRODUCT_ID']; ?>">Enable</a>

                                            <?php } ?>
                                        </td>

                                    <?php } ?>

                                </tr>

                            <?php } ?>
                            </tbody>
                        </table>
                        <p class="d-flex align-items-center">Displaying <?php echo $index;  ?> entry out of <?php echo $row_limit ?> entries

                            <?php if($index > 1) { ?>
                                <a href="http://localhost/website/project/panels/trader-panel/crud-product/displayproduct/displayproduct.php?type=previous&index=<?php echo $index; ?>&min_id=<?php echo $min_product_id; ?>" style="border-radius: 0 !important;" class="btn btn-primary ml-5">Previous</a>

                            <?php }else { ?>
                                <button style="border-radius: 0 !important; box-shadow: none !important;" class="btn btn-primary ml-5">Previous</button>

                            <?php }?>

                            <button style="background: white; border-radius: 0 !important; box-shadow: none !important;" class="btn custom-btn px-3 text-dark"><?php echo $index; ?></button>

                            <?php if($index < $row_limit) { ?>
                                <a href="http://localhost/website/project/panels/trader-panel/crud-product/displayproduct/displayproduct.php?type=next&index=<?php echo $index; ?>&min_id=<?php echo $max_product_id; ?>" style="border-radius: 0 !important;" class="btn btn-primary">Next</a>

                            <?php }else {?>
                                <button style="border-radius: 0 !important; box-shadow: none !important;" class="btn btn-primary">Next</button>

                            <?php  } ?>
                        </p>
                    </div>


                </div>


            </div>
        </div>
    </main>

    <!--External Scripts-->
    <script src="../../../script.js"></script>

<?php } else {
    header('Location: /website/project/index.php');
}


