<?php

session_start();

include_once '../../includes/html-skeleton/skeleton.php';
include_once '../../includes/cdn-links/fontawesome-cdn.php';
include_once '../../includes/cdn-links/bootstrap-cdn.php';

if(isset($_SESSION['user'])) { ?>

<link rel="stylesheet" href="checkout.css">

<div class="custom-container d-flex align-items-center justify-content-center">
    <div class="payment-container">
        <h3 class="font-rale mt-5">Click below button to pay for purchased order.</h3>
        <button class="btn">Paypal</button>
    </div>
</div>


<?php }else {
    header('Location: /website/project/assets/form/signin/signin.php?message=login');
}