<?php

session_start();

include_once "./connection/connect.php";
$connection = getConnection();


//Functions
include_once "./assets/trader-types/functions.php";

//Creating new basket as soon as the new user logs in
if (isset($_SESSION['user'])) {


    $inserted_items = "";
    $customer_id = get_user_type_id($_SESSION['user'], $connection, "CUSTOMERS");
    $count_basket = check_customers_from_basket($customer_id, $connection);

    if($count_basket == 0) {
        insert_into_basket($customer_id, $connection);
    }


    insert_into_basket($_SESSION['user'], $connection);
    $customer_id = get_user_type_id($_SESSION['user'], $connection, "CUSTOMERS");
    $basket_id = get_basket_id_from_baskets($customer_id, $connection);

    if(count($_COOKIE) > 1) {
        $total_price = 0;

        foreach ($_COOKIE as $key => $item) {
            if ($key == "PHPSESSID") {
                continue;
            } else {

                $decodedItem = json_decode($item, true);

                $product_id = $decodedItem['id'] ??= "";
                $quantity = $decodedItem['quantity'] ??= "";

                insert_into_basket_products($basket_id, $product_id, $quantity, $connection);

                $value = fetch_offerid_and_productprice_from_product_id($product_id, $connection);
                $offer_id = $value['offer_id'];
                $product_price = $value['product_price'];
                $discount = fetch_discouted_price_from_products($offer_id, $product_price, $connection);
                $discounted_price = $discount['total_price_after_discount'];
                $final_price = $discounted_price * $quantity;
                $total_price = $total_price + $final_price;
                update_total_sum_from_baskets($basket_id, $customer_id, $total_price, $connection);

                $inserted_items = fetch_cart_items_from_baskets($basket_id, $connection);
                setcookie($product_id, "", time() - (86400 * 30), '/website/project/');
            }
        }

        $count_cart_items = 0;

        while($rows = oci_fetch_assoc($inserted_items)) {
            $count_cart_items++;
        }

        if(isset($_SESSION['count'])) {
            $_SESSION['count'] = $_SESSION['count'] + $count_cart_items;

        }else {
            $_SESSION['count'] = $count_cart_items;
        }

    }else {

        $bool = true;


        if(isset($bool)) {
            $count_basket_products = count_basket_products($basket_id, $connection);

            if(isset($_SESSION['count'])) {
                $_SESSION['count'] = $_SESSION['count'] + $count_basket_products;

            }else {
                $_SESSION['count'] = $count_basket_products;
            }

            $bool = false;
        }


    }
}


include_once "includes/html-skeleton/skeleton.php";
include_once "includes/cdn-links/bootstrap-cdn.php";
include_once "includes/cdn-links/fontawesome-cdn.php";
?>

<!--External CSS-->
<link rel="stylesheet" href="style.css" />


<header>
    <!--Navbar Section-->
    <?php include_once "./includes/page-contents/page-navbar.php" ?>

    <!--Carousel Slider-->
    <div class="position-absolute carousel-container">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="./images/homepage/bg/main-bg.jpg" alt="First slide" />
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="./images/homepage/bg/bg.jpg" alt="Second slide" />
                </div>
            </div>
        </div>
    </div>

    <!--Carouel Headings-->
    <div class="carousel-heading position-absolute text-center">
        <h2 class="font-cursive heading">Welcome to Nature's Fresh Mart</h2>
        <div class="btn-container text-center">
            <a href="/website/project/assets/form/signin/signin.php" class="btn btn-first">Login</a>
            <button class="btn btn-second">Explore</button>
        </div>
    </div>
</header>


<main>
    <!--Why Nature's Fresh Mart-->
    <section class="features mt-5">
        <h2 class="font-cursive text-center">Why Nature's Fresh Mart</h2>
        <hr class="horizantal-break my-3" />

        <div class="container-fluid w-100">
            <div class="row my-5">
                <div class="col-xl-4 border feature-first font-rubik px-5">
                    <p class="text-center mt-3">
                        <img src="./images/homepage/features/orange_travelpictdinner_1484336833.png" alt="dinning" />
                    </p>

                    <h5 class="mt-4 text-center">High Quality Products</h5>
                    <p class="mt-4 text-dark text-justify">
                        <!--TODO : Provide Proper Description--->
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum
                        doloremque dolores inventore dignissimos, consectetur id
                        reiciendis, officiis numquam temporibus molestiae odio itaque
                        accusantium ex eius culpa obcaecati quod dolore quis, deleniti
                    </p>
                </div>

                <div class="col-xl-4 border feature-first font-rubik px-5">
                    <p class="text-center mt-3">
                        <img src="./images/homepage/features/5830939211582692246.svg" class="family" alt="family" />
                    </p>

                    <h5 class="mt-4 text-center">We have a Large Family</h5>
                    <p class="mt-4 text-dark text-justify">
                        <!--TODO : Provide Proper Description--->
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum
                        doloremque dolores inventore dignissimos, consectetur id
                        reiciendis, officiis numquam temporibus molestiae odio itaque
                        accusantium ex eius culpa obcaecati quod dolore quis, deleniti
                    </p>
                </div>

                <div class="col-xl-4 border feature-first font-rubik px-5">
                    <p class="text-center mt-3">
                        <img src="./images/homepage/features/delivery-truck.png" alt="delivery" />
                    </p>

                    <h5 class="mt-4 text-center">Timely delivery</h5>
                    <p class="mt-4 text-dark text-justify">
                        <!--TODO : Provide Proper Description--->
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum
                        doloremque dolores inventore dignissimos, consectetur id
                        reiciendis, officiis numquam temporibus molestiae odio itaque
                        accusantium ex eius culpa obcaecati quod dolore quis, deleniti
                    </p>
                </div>
            </div>
        </div>
    </section>

    <br />

    <!--Why you will love us-->
    <section class="platform-description bg-light pt-5 pb-1">
        <h2 class="font-cursive text-center">Why you'll love us....</h2>
        <hr class="horizantal-break my-3" />

        <div class="container-fluid love-us">
            <div class="row">
                <div class="col-xl-7 font-rubik mt-5">
                    <div class="points d-flex align-items-center">
                        <p class="bullets bullet-first">1</p>
                        <p class="mx-4">
                            On average, plat, insect and bird life is 50% more abundant on
                            organic farms.
                        </p>
                    </div>

                    <br />

                    <div class="points d-flex align-items-center">
                        <p class="bullets">2</p>
                        <p class="mx-4">
                            We deliver to each area on the same day each week, to keep
                            emission low.
                        </p>
                    </div>

                    <br />

                    <div class="points d-flex align-items-center">
                        <p class="bullets">3</p>
                        <p class="mx-4">
                            We're pioneers of low plastic in the UK 75% less plastic in
                            our organic Fruit & Veg Boxes.
                        </p>
                    </div>

                    <br />

                    <div class="points d-flex align-items-center">
                        <p class="bullets">4</p>
                        <p class="mx-4">
                            We reckon our reusable boxes have saved over 65,000 plastic
                            bags.
                        </p>
                    </div>
                </div>

                <div class="col-xl-3 mb-5">
                    <h2 class="ls-f"><strong> AWARD WINNING </strong></h2>
                    <img src="./images/homepage/loveus/pexels-adonyi-gábor-1400172.jpg" width="300px" height="200px"
                        class="love-f-img" alt="vegetables" />

                    <h2 class="ls-s"><strong> SUSTAINABLE </strong></h2>
                    <img src="./images/homepage/loveus/pexels-anton-atanasov-221016.jpg" width="260px" height="160px"
                        class="love-s-img" alt="farm" />
                </div>

                <div class="col-xl-2 align-self-center">
                    <h2 class="ls-t"><strong> SEASONAL </strong></h2>
                    <img src="./images/homepage/loveus/pexels-pixabay-161573.jpg" width="200px" height="150px"
                        class="love-t-img" alt="lemon" />
                </div>
            </div>
        </div>
    </section>

    <!--Trader's Image Section-->
    <section class="header-img my-5">
        <h2 class="text-center font-cursive">Explore our shops</h2>
        <hr class="horizantal-break" />

        <div class="custom-container mt-5">
            <div class="column column-first position-relative">
                <img src="./images/homepage/traders/butcher.jpg" class="column-img" alt="" />
                <a href="/website/project/assets/trader-types/butcher/butcher.php"
                    class="position-absolute font-rale">Butcher</a>
            </div>

            <div class="column column-middle">
                <img src="./images/homepage/traders/fishmonger.jpg" class="column-img" alt="" />
                <a href="/website/project/assets/trader-types/fishmonger/fishmonger.php"
                    class="position-absolute font-rale">Fishmonger</a>
            </div>

            <div class="column column-middle">
                <img src="./images/homepage/traders/delicatessen.jpg" class="column-img" alt="" />
                <a href="/website/project/assets/trader-types/delicatessen/delicatessen.php"
                    class="position-absolute font-rale">Delicatessen</a>
            </div>

            <div class="column column-middle">
                <img src="./images/homepage/traders/greengrocer.jpg" class="column-img" alt="" />
                <a href="/website/project/assets/trader-types/greengrocer/greengrocer.php"
                    class="position-absolute font-rale">Greengrocer</a>
            </div>

            <div class="column column-last">
                <img src="./images/homepage/traders/bakery.jpg" class="column-img" alt="" />
                <a href="/website/project/assets/trader-types/bakery/bakery.php"
                    class="position-absolute font-rale">Bakery</a>
            </div>
        </div>
    </section>

    <br />
    <br />
    <br />

    <!--TODO : Proper Questions and Answer-->
    <!--Frequently asked questions-->
    <section class="w-75 mx-auto item-description my-5">
        <h2 class="font-cursive text-center">Frequently Asked Questions</h2>
        <hr class="horizantal-break my-3" />
        <div class="row my-5">
            <div class="col-5 col-sm-5 col-md-4 col-lg-5 col-xl-4 mx-auto">
                <img src="./images/homepage/faq/undraw_real_time_collaboration_c62i (1).svg" class="w-100" alt="" />
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
                            <p class="font-rale">How to view above image</p>
                            <i class="fas fa-chevron-down"></i>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p class="font-rubik">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                    tempor, sunt aliqua put a bird on it squid single-origin
                                    coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Ad vegan excepteur butcher vice
                                    lomo. Leggings occaecat craft beer farm-to-table, raw
                                    denim aesthetic synth nesciunt you probably haven't heard
                                    of them accusamus labore sustainable VHS.
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
                            <p class="font-rale">What are collection slots</p>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <p class="font-rubik">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                    tempor, sunt aliqua put a bird on it squid single-origin
                                    coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Ad vegan excepteur butcher vice
                                    lomo. Leggings occaecat craft beer farm-to-table, raw
                                    denim aesthetic synth nesciunt you probably haven't heard
                                    of them accusamus labore sustainable VHS.
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
                  " data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                            aria-controls="collapseThree" id="headingThree">
                            <p class="font-rale">More Info</p>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p class="font-rubik">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                    tempor, sunt aliqua put a bird on it squid single-origin
                                    coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Ad vegan excepteur butcher vice
                                    lomo. Leggings occaecat craft beer farm-to-table, raw
                                    denim aesthetic synth nesciunt you probably haven't heard
                                    of them accusamus labore sustainable VHS.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<!--Footer Section-->
<?php include_once "./includes/page-contents/page-footer.php"; ?>

<script src="script.js"></script>