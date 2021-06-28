<?php

//Fetching connnection
include_once "../../../connection/connect.php";
$connection = getConnection();

//Fetching product id from query string
$product_id = $_GET['search'];

//Reviews and Rating
$averageRating = 0;
$totalRating = 0;
$count = 0;

//Offers
$offerPercentage = 0;
$discount = 0;
$totalPriceAfterDiscount = 0;
$offerDescription = "";


if (isset($product_id)) {

    include_once "../../../includes/html-skeleton/skeleton.php";
    include_once "../../../includes/cdn-links/bootstrap-cdn.php";
    include_once "../../../includes/cdn-links/fontawesome-cdn.php"; ?>

    <!--External Sylesheet-->
    <link rel="stylesheet" href="../../trader-product-css/trader-product.css">

    <header class="position-relative">

        <!--Navbar Section-->
        <?php include_once "../../../includes/page-contents/page-navbar.php" ?>


        <div class="bg-image position-absolute">
            <img src="../../trader-images/pexels-karolina-grabowska-5650016.jpg" class="w-100" alt=""/>
        </div>

        <nav class="breadcrumb-navbar" aria-label="breadcrumb">
            <ol class="breadcrumb font-rubik">
                <li class="breadcrumb-item"><a href="/website/project/homepage.php">Home</a></li>
                <li class="breadcrumb-item"><a
                            href="/website/project/trader-types/greengrocer/greengrocer.php">Greengrocer</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Product
                </li>
            </ol>
        </nav>
    </header>


    <?php
    include_once "../../functions.php";
    $result = fetch_individual_products($product_id, $connection);
    ?>


    <main class="my-5">
        <!--Add to Cart-->
        <?php
        //Fetch row of a single product out of all products
        while ($row = oci_fetch_assoc($result)) { ?>
            <section class="w-75 mx-auto cart-info">
                <div class="img-container">
                    <div class="row">
                        <div class="col-12 col-sm-11 col-md-8 col-lg-5 col-xl-5">
                            <img src="../images/products/<?php echo $row['PRODUCT_IMAGE'] ?>" class="w-100" alt=""/>
                        </div>
                        <div class="col-12 col-sm-11 col-md-8 col-lg-7 col-xl-7 font-rale">
                            <!--TODO : Provide action for form-->
                            <form action="#" method="POST" class="form">
                                <fieldset>
                                    <p>
                                        <?php echo $row['PRODUCT_NAME'] ?>
                                    </p>

                                    <!--Calculating Rating of product-->
                                    <div class="rating-container">
                                        <?php

                                        $resultSecond = fetch_reviews_from_products($product_id, $connection);

                                        while ($rowSecond = oci_fetch_assoc($resultSecond)) {
                                            $totalRating += $rowSecond['REVIEW_RATING'];
                                            $count++;
                                        }

                                        if ($count > 0) {
                                            //Calculating average rated value
                                            $averageRating = round($totalRating / $count);
                                        }


                                        for ($i = 1; $i <= $averageRating; $i++) { ?>
                                            <i class="fas fa-star text-warning"></i>
                                        <?php }

                                        //Calculating unrated value
                                        $remainingRating = 5 - $averageRating;

                                        for ($i = 1; $i <= $remainingRating; $i++) { ?>
                                            <i class="far fa-star text-warning"></i>
                                        <?php } ?>

                                        <span>(<?php echo $count; ?>)</span>
                                    </div>

                                    <!--Calculating Offers for individual product-->
                                    <?php

                                    $offerId = $row['FK_OFFER_ID'];
                                    $productPrice = $row['ITEM_PRICE'];


                                    $resultThird = fetch_discouted_price_from_products($offerId, $productPrice, $connection);

                                    ?>

                                    <div class="pricing-container my-4">
                                        <p class="my-0">
                                            <del>$<?php echo number_format($productPrice, '2', '.'); ?></del>
                                            <span class="mx-3">(Including all taxes)</span>
                                        </p>
                                        <p class="discount">$<?php echo $resultThird['total_price_after_discount']; ?><span
                                                    class="rounded">-<?php echo $resultThird['offer_percentage']; ?>%</span></p>
                                    </div>

                                    <div class="order-quantity d-flex align-items-start my-3">
                                        <p class="mr-2">Quantity :</p>

                                        <div class="quantity ml-3 d-flex">
                                            <button type="button" class="btn decrease-btn">-</button>
                                            <input class="form-control w-25 text-center" value="1"
                                                   name="product_quantity">
                                            <button type="button" class="btn increase-btn">+</button>
                                        </div>
                                    </div>
                                    <div class="order-btn__container my-3">
                                        <button type="submit" class="btn btn-md btn-primary">Add to Cart</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </section>


            <section class="w-75 mx-auto item-description my-5">
                <div class="row my-5">
                    <div class="col-5 col-sm-5 col-md-4 col-lg-5 col-xl-4 mx-auto d-flex">
                        <img src="../../trader-images/undraw_real_time_collaboration_c62i%20(1).svg" class="w-75 mx-auto" alt=""/>
                    </div>
                    <div class="col-10 col-sm-10 col-md-7 col-lg-6 col-xl-6 mx-auto">
                        <div id="accordion">
                            <div class="card">
                                <div class="
                    card-header
                    d-flex
                    align-items-start
                    justify-content-between
                  " data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                     id="headingOne">
                                    <p class="font-rale">Description</p>
                                    <i class="fas fa-chevron-down"></i>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="font-rubik">
                                            <?php echo $row['PRODUCT_INFO'] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="
                    card-header
                    d-flex
                    align-items-center
                    justify-content-between
                  " data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"
                                     id="headingTwo">
                                    <p class="font-rale">Allergy Information</p>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="font-rubik">
                                            <?php echo $row['ALLERGY_INFO'] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="
                    card-header
                    d-flex
                    align-items-center
                    justify-content-between
                  " data-toggle="collapse" data-target="#collapseThree"
                                     aria-expanded="false" aria-controls="collapseThree" id="headingThree">
                                    <p class="font-rale">Offer Description</p>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="font-rubik">
                                            <?php echo $resultThird['offer_description']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <br>

            <section class="w-75 mx-auto product-review my-5">
                <h3 class="font-rale text-center">Product's Ratings & Reviews</h3>
                <hr class="hr"/>

                <div class="row mx-auto my-4">
                    <!--Total Average Ratings-->
                    <div class="col-xl-4 mx-auto my-4">
                        <p class="text-center font-rubik"><?php echo number_format($averageRating, 1, '.'); ?>/5</p>
                    </div>

                    <?php

                    $resultFourth = fetch_reviews_from_products($product_id, $connection);

                    $fiveStars = 0;
                    $fourStars = 0;
                    $threeStars = 0;
                    $twoStars = 0;
                    $oneStars = 0;


                    while ($rowFourth = oci_fetch_assoc($resultFourth)) {
                        if ($rowFourth['REVIEW_RATING'] == 5) {
                            $fiveStars++;
                        }

                        if ($rowFourth['REVIEW_RATING'] == 4) {
                            $fourStars++;
                        }
                        if ($rowFourth['REVIEW_RATING'] == 3) {
                            $threeStars++;
                        }

                        if ($rowFourth['REVIEW_RATING'] == 2) {
                            $twoStars++;
                        }

                        if ($rowFourth['REVIEW_RATING'] == 1) {
                            $oneStars++;
                        }

                    }
                    ?>

                    <div class="col-xl-5 my-4 mx-auto border p-3">
                        <div class="row">
                            <!--Ratings stars-->
                            <div class="col-xl-6">
                                <div class="icon-container">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <span class="mx-2">(<?php echo $fiveStars; ?>)</span>
                                </div>
                            </div>

                            <!--Progress Bar-->
                            <div class="col-xl-6">
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                         style="width: <?php echo $fiveStars; ?>0%" aria-valuenow="100"
                                         aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="icon-container">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                    <span class="mx-2">(<?php echo $fourStars; ?>) </span>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                         style="width: <?php echo $fourStars; ?>0%" aria-valuenow="100"
                                         aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="icon-container">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                    <span class="mx-2">(<?php echo $threeStars; ?>)</span>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="progress">
                                    <div class="progress-bar bg-secondary" role="progressbar"
                                         style="width: <?php echo $threeStars ?>0%" aria-valuenow="100"
                                         aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="icon-container">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                    <span class="mx-2">(<?php echo $twoStars; ?>)</span>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                         style="width: <?php echo $twoStars; ?>0%" aria-valuenow="100" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="icon-container">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                    <span class="mx-2">(<?php echo $oneStars; ?>)</span>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                         style="width: <?php echo $oneStars; ?>0%" aria-valuenow="100" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="w-75 mx-auto comments my-5">
                <div class="container-fluid">
                    <?php

                    $resultFifth = fetch_all_reviews_and_rating($product_id, $connection);

                    while ($rowFifth = oci_fetch_assoc($resultFifth)) { ?>

                        <!--Individual Comments section-->
                        <div class="individual-comments font-rubik my-5">
                            <div class="customer-rating w-100">
                                <p class="d-inline username">
                                    <?php echo $rowFifth['FIRST_NAME']; ?><?php echo $rowFifth['LAST_NAME']; ?></p>


                                <div class="rating-container d-inline mx-3">
                                <?php

                                $rating = 0;
                                $rating = $rowFifth['REVIEW_RATING'];

                                if($rating > 0) {
                                    for($i = 1; $i <= $rating; $i++) { ?>
                                        <i class="fas fa-star text-warning"></i>
                                    <?php }

                                    $unrated = 5 - $rating;
                                    for($i = 1; $i <= $unrated; $i++) { ?>
                                        <i class="far fa-star text-warning"></i>
                                   <?php  }
                                }
                                ?>
                                </div>


                            </div>
                            <hr class="break"/>
                            <p class="description">
                                <?php

                                if (!empty($rowFifth['REVIEW_COMMENT'])) {
                                    echo $rowFifth['REVIEW_COMMENT'];
                                } else {
                                    echo "No comments";
                                }
                                ?>
                            </p>
                        </div>

                    <?php } ?>
                </div>
            </section>

        <?php } ?>
    </main>

    <!--Footer Section-->
    <?php include_once "../../../includes/page-contents/page-footer.php"; ?>

    <!--External Script-->
    <script src="../../trader-scripts/vendor.js"></script>

<?php } else {
    header('Location: /website/project/trader-types/greengrocer/greengrocer.php');
} ?>