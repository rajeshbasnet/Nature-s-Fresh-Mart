<?php

include_once "../../../../connection/connect.php";

include_once "../../../../includes/html-skeleton/skeleton.php";
include_once "../../../../includes/cdn-links/fontawesome-cdn.php";
include_once "../../../../includes/cdn-links/bootstrap-cdn.php";

$connection = getConnection();

$token = $_GET['token'];

$query = "SELECT TOKEN FROM USERS WHERE USERS.TOKEN = '$token'";
$result = oci_parse($connection, $query);
oci_execute($result);

$count = 0;

while($row = oci_fetch_assoc($result)) {
    $count++;
}

if($count == 1) {
    $query = "UPDATE USERS SET STATUS = 1 WHERE USERS.TOKEN = '$token'";
    $resultAfter = oci_parse($connection, $query);
    oci_execute($resultAfter);

    ?>

    <div class="w-50 mx-auto mt-5">
        <p class="alert alert-success text-center font-rale"><b>Your account has been verified. Go to login page and enjoy shopping, thank you.</b></p>
        <div class="text-center">
            <a href="/website/project/assets/form/signin/signin.php" class="btn btn-primary">Go back to Login page</a>
        </div>
    </div>

<?php }else { ?>
    <div class="w-50 mx-auto mt-5">
        <p class="alert alert-success text-center font-rale"><b>Verification failed. Please, try again later.</b></p>
        <div class="text-center">
            <a href="/website/project/homepage.php" class="btn btn-primary">Go back to Registration page</a>
        </div>
    </div>

<?php }
