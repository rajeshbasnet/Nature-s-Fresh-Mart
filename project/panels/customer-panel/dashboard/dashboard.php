<?php

session_start();

if (isset($_SESSION['user'])) {

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
                <?php include '../customer-side-panel.php' ?>

                <!--display Products Container Column-->
                <div class="col-xl-10 mx-auto p-0">
                    <?php

                    include_once '../../../assets/trader-types/functions.php';
                    $profile_img = get_profile_image_of_user($_SESSION['user'], $connection);

                    echo "<div class='user-profile-header'>";

                    if (empty($profile_img)) {
                        $profile_img = "default-image.jpg";
                    }

                    echo "<img src='../profile/profile-img/" . $profile_img . "' alt='profile-icon' width='40px' height='40px'>";
                    echo "</div>";

                    ?>

                    <div class="logout-section position-absolute">
                        <p class="p-2"><a href="/website/project/panels/logout.php" class="btn text-light">logout</a>
                        </p>
                    </div>


                    <div class="table-container my-5 mx-4">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <th>Product Price</th>
                            <th>Product Image</th>
                            <th>Product Price</th>
                            <th>Qty.</th>
                            <th>Purchase Time</th>
                            <th>Purchased Date</th>
                            </thead>
                            <tbody>
                            <?php

                            $customer_id = get_user_type_id($_SESSION['user'], $connection, "CUSTOMERS");
                            $query = "SELECT * FROM ORDERS, BASKETS, BASKET_PRODUCTS, PRODUCTS, CUSTOMERS, COLLECTION_SLOTS
                                WHERE ORDERS.FK_BASKET_ID = BASKETS.BASKET_ID AND 
                                BASKET_PRODUCTS.FK_BASKET_ID = BASKETS.BASKET_ID AND
                                BASKET_PRODUCTS.FK_PRODUCT_ID = PRODUCTS.PRODUCT_ID AND 
                                BASKETS.FK_CUSTOMER_ID = CUSTOMERS.CUSTOMER_ID AND
                                ORDERS.FK_COLLECTION_SLOT_ID = COLLECTION_SLOTS.COLLECTION_SLOT_ID AND CUSTOMERS.CUSTOMER_ID = $customer_id";

                            $result = oci_parse($connection, $query);
                            oci_execute($result);

                            while ($rows = oci_fetch_assoc($result)) {

                                $time = $rows['COLLECTION_TIME'] . ' - ' . $rows['COLLECTION_DAY'];

                                ?>

                                <tr>
                                    <td><?php echo $rows['PRODUCT_NAME'] ?></td>

                                    <?php $trader_type = fetch_trader_type_from_product($rows['PRODUCT_ID'], $connection); ?>
                                    <td><img src="/website/project/assets/trader-types/<?php echo $trader_type ?>/images/products/<?php echo $rows['PRODUCT_IMAGE'] ?>" alt=""></td>
                                    <td>£<?php echo $rows['ITEM_PRICE'] ?></td>
                                    <td><?php echo $rows['QUANTITY'] ?></td>
                                    <td><?php echo $time ?></td>
                                    <td><?php echo $rows['PAYMENT_DATE'] ?></td>
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