<?php

session_start();

//Fetch Connection
include_once "../../../connection/connect.php";
$connection = getConnection();

include_once "../../../includes/html-skeleton/skeleton.php";
include_once "../../../includes/cdn-links/bootstrap-cdn.php";
include_once "../../../includes/cdn-links/fontawesome-cdn.php";
?>

    <!--External CSS-->
    <link rel="stylesheet" href="../trader-css/traders.css">

    <header>

        <!--Navbar Section-->
        <?php include_once "../../../includes/page-contents/page-navbar.php" ?>

        <div class="bg-image position-absolute">
            <img src="images/bg-img/pexels-madison-inouye-192933.jpg" class="w-100" alt=""/>
        </div>


        <div class="
          trader-description
          position-absolute
          font-rubik
          text-dark
          py-2
          px-4
        ">
            <h2 class="text-center mb-4">Bakery</h2>
            <p class="text-center font-rubik">
                <!--TODO : Proper Description-->
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit
                corporis aliquid pariatur reiciendis laborum hic facere doloribus
                voluptate ipsum similique omnis, unde incidunt accusantium. Incidunt
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </p>
        </div>
    </header>


    <br/>
    <br/>

    <main>
        <!--Search and Sort section-->
        <section class="sidebar-section">
            <div class="container-fluid">
                <div class="row d-flex align-items-baseline justify-content-between">
                    <div class="breadcrumb-section">
                        <!--Breadcrumbs-->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-2 font-rubik">
                                <li class="breadcrumb-item">
                                    <a href="/website/project/homepage.php">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="/website/project/assets/trader-types/bakery/bakery.php">Bakery</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Products
                                </li>
                            </ol>
                        </nav>
                    </div>

                    <!--Search and sort form-->
                    <div class="search-sort">
                        <form action="#" class="d-flex align-items-center justify-content-end">
                            <div class="search-field mx-2">
                                <input type="text" class="form-control font-rubik" name="search"
                                       placeholder="Eg. Bananas, Apple"/>
                            </div>

                            <div class="sort-field mx-2">
                                <select name="sort-items" id="sort-items" class="form-control font-rubik">
                                    <option value="" selected disabled>Sort By</option>
                                    <option value="high">Price (Highest)</option>
                                    <option value="low">Price (Lowest)</option>
                                    <option value="asc">Product name</option>
                                </select>
                            </div>

                            <div class="btn-container mx-2 font-rubik">
                                <button class="btn btn-md">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <br/>
        <br/>

        <?php

        include_once "../functions.php";
        $result = fetch_all_products_of_trader("bakery", $connection);
        ?>

        <!--Products Section-->
        <section class="traders-products border">
            <div class="container-fluid w-100">
                <div class="products">


                    <!--Individual Products-->
                    <?php

                    while ($row = oci_fetch_assoc($result)) { ?>
                        <div class="individual-product">
                            <div class="img-container position-relative">
                                <img src="./images/products/<?php echo $row['PRODUCT_IMAGE'] ?>" alt=""/>
                                <i class="fas fa-search position-absolute"></i>
                            </div>
                            <div class="info d-flex align-items-baseline justify-content-between mt-3">
                                <p class="font-rubik"><?php echo $row['PRODUCT_NAME'] ?></p>
                                <?php $discounted_result = fetch_discouted_price_from_products($row['FK_OFFER_ID'], $row['ITEM_PRICE'], $connection) ?>
                                <p class="font-rubik price-content">
                                    $<?php echo $discounted_result['total_price_after_discount'] ?></p>
                            </div>
                            <div class="btn-container font-rubik">
                                <a href="/website/project/assets/trader-types/individual-product/individual-product.php?search=<?php echo $row['PRODUCT_ID'] ?>&type=bakery"
                                   class="btn btn-dark">View Product</a>
                            </div>
                        </div>
                    <?php } ?>


                </div>
            </div>
        </section>
    </main>

    <!--Footer Section-->
<?php include_once "../../../includes/page-contents/page-footer.php"; ?>