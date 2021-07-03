<?php

session_start();


if (isset($_SESSION['trader'])) {

    include_once "../../../../connection/connect.php";
    $connection = getConnection();

    include_once "../../../../includes/html-skeleton/skeleton.php";
    include_once "../../../../includes/cdn-links/fontawesome-cdn.php";
    include_once "../../../../includes/cdn-links/bootstrap-cdn.php"; ?>

    <!--External Stylesheet-->
    <link rel="stylesheet" href="addproduct.css">

    <main>
        <div class="container-fluid">
            <div class="row">
                <?php include '../../trader-side-panel.php' ?>

                <!--Add Products Container Column-->
                <div class="col-xl-10 mx-auto p-0">

                    <?php

                    include_once '../../../../assets/trader-types/functions.php';
                    $profile_img = get_profile_image_of_user($_SESSION['trader'], $connection);

                    echo "<div class='user-profile-header'>";

                    if (!isset($profile_image)) {
                        $profile_image = "default-image.jpg";
                    }

                    echo "<img src='../../profile/profile-img/" . $profile_img . "' alt='profile-icon' width='40px' height='40px'>";
                    echo "</div>";

                    ?>

                    <div class="logout-section position-absolute">
                        <p class="p-2"><a href="/website/project/panels/logout.php" class="btn text-light">logout</a>
                        </p>
                    </div>

                    <?php include "./check-product.php"; ?>


                    <form action="#" method="POST" enctype="multipart/form-data">
                        <fieldset>

                            <!--Title-->
                            <h4 class="addproduct-title my-4">Add Products</h4>

                            <div class="input-field__container d-flex">

                                <!--Left Input Field Column-->
                                <div class="column-left w-100 mr-3">
                                    <div class="product-name">
                                        <label for="product-name" class="form-label">Product Name<span class="text-danger">*</span></label>
                                        <input type="text" id="product-name" class="form-control" name="product-name"
                                               placeholder="E.g. Whole Grain Sliced Bread"/>
                                    </div>

                                    <br/>

                                    <div class="product-price">
                                        <label for="product-price" class="form-label">Product Price<span class="text-danger">*</span></label>
                                        <input type="number" id="product-price" class="form-control"
                                               name="product-price"
                                               placeholder="E.g. 35"/>
                                    </div>
                                    <?php if (isset($pnameerror)) {
                                        echo $pnameerror;
                                    } ?>

                                    <br/>

                                    <div class="product-quantity">
                                        <label for="product-quantity" class="form-label">Quantity in stock<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="product-quantity"
                                               name="product-quantity"
                                               placeholder="Total number of available product"/>
                                    </div>

                                    <br/>

                                    <div class="product-availability">
                                        <label for="form-label" class="product-availability">Product
                                            Availability<span class="text-danger">*</span></label>
                                        <select name="product-availability" id="product-availability"
                                                class="form-control">
                                            <option value="1">Yes (Default)</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>

                                    <br>

                                    <div class="product-desc">
                                        <label for="product-desc">Product Description<span class="text-danger">*</span></label>
                                        <textarea name="product-desc" id="product-desc" rows="5" class="form-control" placeholder="Description about product"></textarea>
                                    </div>


                                </div>

                                <div class="column-right w-100 ml-3">


                                    <div class="product-allergy__info">
                                        <label for="product-allergy__info" class="form-label">Allergy
                                            Information</label>
                                        <textarea rows="5" class="form-control" id="product-allergy__info" name="product-allergy__info"></textarea>
                                    </div>

                                    <div style="margin-top: 30px;" class="offer_code">
                                        <label for="fk_offer_id" class="form-label">Offer code</label>
                                        <input type="number" class="form-control" id="fk_offer_id" name="fk_offer_id"/>
                                    </div>

                                    <br/>

                                    <div class="img-select mb-1">
                                        <input type="file" name="product-img" id="product-img"/>
                                    </div>
                                    <?php if (isset($img_error)) {
                                        echo $img_error;
                                    } ?>
                                    <span class="note"><b>Note : </b>Default image will be uploaded if not choosen any image.</span>
                                </div>

                            </div>

                            <!--Button Field Container-->
                            <div class="btn-container mt-4 mb-3 d-flex">
                                <button type="submit" name="insertProduct" class="btn btn-primary w-100 mr-2">ADD
                                    PRODUCT
                                </button>
                                <button type="reset" class="btn btn-danger w-100 ml-2">CLEAR ALL</button>
                            </div>
                        </fieldset>
                    </form>


                </div>
            </div>
        </div>
    </main>

    <!--External Scripts-->
    <script src="../../../script.js"></script>

<?php } else {
    header('Location: /website/project/homepage.php');
}