<?php

session_start();

if(isset($_SESSION['trader'])) {
    $user_id = $_SESSION['trader'];

}elseif(isset($_SESSION['admin_as_trader'])) {
    $user_id = $_SESSION['admin_as_trader'];
}

if (isset($user_id)) {

    include_once "../../../connection/connect.php";
    $connection = getConnection();

    include_once "../../../assets/trader-types/functions.php";

    include_once "../../../includes/html-skeleton/skeleton.php";
    include_once "../../../includes/cdn-links/fontawesome-cdn.php";
    include_once "../../../includes/cdn-links/bootstrap-cdn.php"; ?>

    <!--External Stylesheet-->
    <link rel="stylesheet" href="dashboard.css">


    <main>
        <div class="container-fluid">

            <div class="row">
                <?php include '../trader-side-panel.php' ?>

                <!--display Products Container Column-->
                <div class="col-xl-10 mx-auto p-0">
                    <?php

                    include_once '../../../assets/trader-types/functions.php';
                    $profile_img = get_profile_image_of_user($user_id, $connection);

                    echo "<div class='user-profile-header'>";

                    if (empty($profile_img)) {
                        $profile_img = "default-image.jpg";
                    }

                    $trader_id = get_user_type_id($user_id, $connection, "TRADERS");
                    $trader_type = get_trader_type_from_traders($trader_id, $connection);

                    echo "<p class='trader-type'>" . strtoupper($trader_type) . "</p>";

                    echo "<img src='../profile/profile-img/" . $profile_img . "' alt='profile-icon' width='40px' height='40px'>";
                    echo "</div>";

                    ?>

                    <div class="logout-section position-absolute">
                        <p class="p-2"><a href="/website/project/panels/logout.php" class="btn text-light">logout</a>
                        </p>
                    </div>


                    <div class="table-container my-5 mx-4">
                        <table class="table table-hover table-bordered">
                            <thead class="text-uppercase">
                            <th>Order No</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Qty.</th>
                            <th>Payment Date</th>
                            <th>Delivery time</th>
                            <th>Delivery Day</th>
                            <th>Order Status</th>
                            </thead>
                            <tbody>
                            <?php

                            $query = "SELECT  order_id,   orders.payment_date,  product_name, item_price, basket_products.quantity,collection_time,collection_day ,order_status 
                                    FROM ORDERS, BASKETS, BASKET_PRODUCTS, PRODUCTS, users, traders, shops,collection_slots
                                    WHERE  ORDERS.FK_BASKET_ID = BASKETS.BASKET_ID AND BASKET_PRODUCTS.FK_BASKET_ID = BASKETS.BASKET_ID
                                    AND BASKET_PRODUCTS.FK_PRODUCT_ID = PRODUCTS.PRODUCT_ID AND orders.fk_collection_slot_id=collection_slots.collection_slot_id AND PRODUCTS.fk_shop_id = shops.shop_id
                                    AND shops.fk_trader_id = traders.trader_id AND traders.user_id = users.user_id AND users.user_id= '$user_id' ORDER BY order_id desc";

                            $result = oci_parse($connection, $query);
                            oci_execute($result);

                            $index = 0;
                            while ($rows = oci_fetch_assoc($result)) { $index++;?>

                                <tr>
                                    <td><?php echo $index; ?></td>
                                    <td><?php echo $rows['PRODUCT_NAME']; ?></td>
                                    <td><?php echo $rows['ITEM_PRICE']; ?></td>
                                    <td><?php echo $rows['QUANTITY']; ?></td>
                                    <td><?php echo $rows['PAYMENT_DATE']; ?></td>
                                    <td><?php echo $rows['COLLECTION_TIME']; ?></td>
                                    <td><?php echo $rows['COLLECTION_DAY']; ?></td>
                                    <td><?php echo $rows['ORDER_STATUS'] ?></td>
                                </tr>

                            <?php } ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!--External Script-->
    <script src="../../script.js"></script>

<?php } else {
    header('Location: /website/project/homepage.php');
}