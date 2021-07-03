<?php

session_start();

if (isset($_SESSION['trader'])) {
    $user_id = $_SESSION['trader'];

} elseif (isset($_SESSION['admin_as_trader'])) {
    $user_id = $_SESSION['admin_as_trader'];

}else {
    $user_id = "";
}

if (!empty($user_id)) {

    $is_deleted = $_GET['delete'] ??= "";

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

                    echo "<div class='user-profile-header'>";

                    if (!isset($profile_img)) {
                        $profile_img = "default-image.jpg";
                    }

                    echo "<img src='../../profile/profile-img/" . $profile_img . "' alt='profile-icon' width='40px' height='40px'>";
                    echo "</div>";

                    ?>

                    <div class="logout-section position-absolute">
                        <p class="p-2"><a href="/website/project/panels/logout.php" class="btn text-light">logout</a>
                        </p>
                    </div>


                    <?php

                    if ($is_deleted == 'success') {
                        echo "<p style='border-width:2px !important; font-size: 1.1rem; font-weight : bold;' class='text-success border p-2 border-success w-50 mx-auto text-center mt-4'><i class='fas fa-check-circle'></i>&nbsp;&nbsp;SUCCESS: PRODUCT REMOVED SUCCESSFULLY</p>";
                    }

                    $trader_id = get_user_type_id($user_id, $connection, "TRADERS");
                    $trader_type = get_trader_type_from_traders($trader_id, $connection);
                    $result = fetch_all_products_of_trader($trader_type, $connection);
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
                                    <td><?php echo $rows['ITEM_PRICE'] ?></td>
                                    <td class="product-info"><?php echo $rows['PRODUCT_INFO'] ?></td>
                                    <td><?php echo $rows['QUANTITY_IN_STOCK'] ?></td>
                                    <td class="allergy-info"><?php echo $rows['ALLERGY_INFO'] ?></td>
                                    <td><?php echo $rows['AVAILABLILITY'] ?></td>
                                    <td><?php echo $rows['MAX_ORDER'] ?></td>
                                    <td><?php echo $rows['MIN_ORDER'] ?></td>
                                    <td><?php echo $rows['FK_OFFER_ID'] ?></td>
                                    <td class="action"><a
                                                href="http://localhost/website/project/panels/trader-panel/crud-product/deleteproduct/deleteproduct.php?id=<?php echo $rows['PRODUCT_ID']; ?>">Delete</a>
                                        |
                                        <a href="http://localhost/website/project/panels/trader-panel/crud-product/updateproduct/updateproduct.php?id=<?php echo $rows['PRODUCT_ID']; ?>">Update</a>
                                    </td>
                                </tr>

                            <?php } ?>
                            </tbody>
                        </table>
                    </div>


                </div>


            </div>
        </div>
    </main>

    <!--External Scripts-->
    <script src="../../../script.js"></script>

<?php } //} else {
//    header('Location: /website/project/homepage.php');
//}


