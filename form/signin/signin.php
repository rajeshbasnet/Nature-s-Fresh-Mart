<?php

include_once "../../connection/connect.php";
$connection = getConnection();

include_once "../../includes/html-skeleton/skeleton.php";
include_once "../../includes/cdn-links/fontawesome-cdn.php";
include_once "../../includes/cdn-links/bootstrap-cdn.php";

?>

<!--External Stylesheet-->
<link rel="stylesheet" href="signin.css">


<div class="container-fluid">
    <div class="custom-container d-flex justify-content-center align-items-center
        ">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-6 mx-auto column-first
            ">
                <form action="#" method="POST">
                    <fieldset>
                        <h4 class="text-center font-rubik">
                            Sign in to Nature's Fresh Mart
                        </h4>
                        <div class="icon-container d-flex align-items-center justify-content-center my-4">
                            <i class="fab fa-facebook-f mx-3"></i>
                            <i class="fab fa-google mx-3"></i>
                            <i class="fab fa-linkedin-in mx-3"></i>
                        </div>

                        <!--Fetching page that has login proccess-->
                        <?php include_once "check-signin.php"; ?>

                        <?php if(isset($errors['login'])) {
                            echo $errors['login'];
                        } ?>


                        <?php if(isset($success)) {
                            echo $success;
                        } ?>

                        <div class="input-field w-75 mx-auto my-4">
                            <div class="email-field position-relative my-4">
                                <input type="email" id="user-email" class="form-control" placeholder="Email"
                                       name="user-email" />
                                <i class="fas fa-envelope position-absolute custom-icon"></i>
                            </div>

                            <div class="password-field my-4 position-relative">
                                <input type="password" class="form-control" placeholder="Password" id="user-password"
                                       name="user-password" />
                                <i class="fas fa-lock position-absolute custom-icon"></i>
                            </div>

                            <div class="role-field my-4">
                                <select name="user-type" id="user-type" class="form-control form-control-lg">
                                    <option value="customers">Customer</option>
                                    <option value="traders">Trader</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <p class="text-center my-4">
                                <a href="/website/project/homepage.php">Home</a> |
                                New to Nature's Fresh Mart ? <a class="signup"
                                                                href="/website/project/form/signup/customer-signup/customer-signup.php">Click
                                    here...</a>
                            </p>

                            <div class="btn-container text-center my-4 d-block">
                                <button type="submit" class="btn btn-md btn-primary" name="form-submit">SIGN IN</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
