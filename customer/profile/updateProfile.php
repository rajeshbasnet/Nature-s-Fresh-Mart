<?php

    include 'Connection.php';

    if (isset($_POST['saveProfile '])) {
        $userId = $_POST['user_id'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $userEmail = $_POST['userEmail'];
        $userPhone = $_POST['phone-number'];
        $userAddress = $_POST['address'];

        $query2 = "UPDATE users SET  first_name = '$firstName', last_name = '$lastName', address = '$userAddress', email = '$userEmail', phone_number = '$userPhone'";

        if(mysqli_query($connection, $query2)){
            echo "<button type='button' class='btn btn-outline-success btn-lg' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>Profile has been updated</button>";
        }else{
            echo "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>ERROR: Could not execute query</button>";
        }
        header("Location: http://localhost/Nature-s-Fresh-Mart/trader/profile/traderProfile.php");
    }
?>
