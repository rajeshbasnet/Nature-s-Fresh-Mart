<?php

include_once "../../form-functions.php";


$connection = getConnection();

//Final variables after sanitization
$customerAddr = "";
$customerFirstName = "";
$customerLastName = "";
$customerEmail = "";
$customerPhoneNum = "";
$customerPassword = "";

//Variables to display errors
$errors = [];
$success_msg = "";
$mail_error_msg = "";


if (isset($_POST['customerSubmit'])) {

    //Fetch from input
    $addr = $_POST['custAddress'] ??= "";
    $firstName = $_POST['custFirstname'] ??= "";
    $lastName = $_POST['custLastname'] ??= "";
    $email = $_POST['custEmail'] ??= "";
    $phoneNum = $_POST['custPhone'] ??= "";
    $password = $_POST['custPassword'] ??= "";
    $password_check = $_POST['custPasswordCheck'] ??= "";
    $password_check = htmlspecialchars(trim($password_check));


    if (!empty($firstName) && !empty($lastName)) {

        //Checking whether names contain numbers or not
        if (!preg_match('~[0-9]~', $firstName) && !preg_match('~[0-9]~', $lastName)) {

            //Firstname and lastname cannot be greater than 20
            if (strlen($firstName) > 20 || strlen($lastName) > 20) {
                $errors['name'] = "<p class='text-danger  p-0 m-0 d-flex align-items-center '><i class='fas fa-times-circle text-danger'></i>&nbsp;Firstname and Lastname has limit of 20 letters long</p>";

            } else {
                $customerFirstName = $firstName;
                $customerLastName = $lastName;
            }
        } else {
            $errors['name'] = "<p class='text-danger p-0 m-0  d-flex align-items-center'><i class='fas fa-times-circle text-danger'></i>&nbsp;Firstname and Lastname cannot contain numbers</p>";
        }
    } else {
        $errors['name'] = "<p class='text-danger  p-0 m-0 d-flex align-items-center'><i class='fas fa-times-circle text-danger'></i>&nbsp;Firstname or Lastname cannot be empty</p>";
    }


    if (!empty($addr)) {
        $customerAddr = trim($addr);

    } else {
        $errors['address'] = "<p class='text-danger  p-0 m-0 d-flex align-items-center'><i class='fas fa-times-circle text-danger'></i>&nbsp;Address field cannot be empty</p>";
    }


    if (!empty($email)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $count = count_emails_from_users($email, "CUSTOMERS", $connection);

            if ($count > 0) {
                $errors['email'] = "<p class='text-danger p-0 m-0 d-flex align-items-centerX'><i class='fas fa-times-circle text-danger'></i>&nbsp;Sorry, Email already exists.</p>";

            } else {
                $customerEmail = $email;
            }

        } else {
            $errors['email'] = "<p class='text-danger p-0 m-0 d-flex align-items-centerX'><i class='fas fa-times-circle text-danger'></i>&nbsp;Given email is in invalid format</p>";
        }
    } else {
        $errors['email'] = "<p class='text-danger p-0 m-0 d-flex align-items-center'><i class='fas fa-times-circle text-danger'></i>&nbsp;Email field cannot be empty</p>";
    }


    if (!empty($phoneNum)) {
        if (preg_match("*^[0-9]+$*", $phoneNum)) {

            if (strlen($phoneNum) === 10) {

                $count = count_phonenum_from_users($phoneNum, "CUSTOMERS", $connection);

                if ($count > 0) {
                    $errors['phonenum'] = "<p class='text-danger p-0 m-0 d-flex align-items-centerX'><i class='fas fa-times-circle text-danger'></i>&nbsp;Sorry, Phone number already exists.</p>";
                } else {
                    $customerPhoneNum = $phoneNum;
                }

            } else {
                $errors['phonenum'] = "<p class='text-danger p-0 m-0 d-flex align-items-center'><i class='fas fa-times-circle text-danger'></i>&nbsp;Phone number should be 10 characters long</p>";
            }

        } else {
            $errors['phonenum'] = "<p class='text-danger p-0 m-0 d-flex align-items-center'><i class='fas fa-times-circle text-danger'></i>&nbsp;Given phone number is invalid</p>";
        }
    } else {
        $errors['phonenum'] = "<p class ='text-danger p-0 m-0 d-flex align-items-center'><i class='fas fa-times-circle text-danger'></i>&nbsp;Phone Number cannot be empty</p>";
    }

    if (!empty($password)) {

        if (preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) && (1 === preg_match('~[0-9]~', $password)) && strlen($password) >= 6) {
            $customerPassword = md5($password);

            if ($password !== $password_check) {
                $errors['password_check'] = "<p class='text-danger p-0 m-0 d-flex align-items-center'><i class='fas fa-times-circle text-danger'></i>&nbsp;Sorry, your password doesn't matches with current password.</p>";
            }

        } else {

            $errors['password'] = "<p class='text-danger p-0 m-0 d-flex align-items-start'> <i class='fas fa-times-circle text-danger'></i>&nbsp;Password must be 6 characters long, must contains at least one uppercase letter, one lowercase letter and a number</p>";
        }
    } else {
        $errors['password'] = "<p class='text-danger p-0 m-0 d-flex align-items-center'><i class='fas fa-times-circle text-danger'></i>&nbsp;Password field cannot be empty</p>";
    }


    if (empty($errors['name']) && empty($errors['address']) && empty($errors['email']) && empty($errors['phonenum']) && empty($errors['password']) && empty($errors['password_check'])) {

        $success_msg = "";
        $token = "";

        try {
            $token = bin2hex(random_bytes(15));
        } catch (Exception $e) {
            echo $e;
        }


        $query_for_users = "INSERT INTO USERS(USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS) VALUES (null, '$customerFirstName', '$customerLastName', '$customerAddr', '$customerEmail', $customerPhoneNum, '$customerPassword', null , '$token', 0 )";

        $result_for_users = oci_parse($connection, $query_for_users);
        oci_execute($result_for_users);

        //Fetching user id after inserting into users
        $query_for_token = "SELECT * FROM USERS WHERE USERS.TOKEN = '$token'";
        $result_for_token = oci_parse($connection, $query_for_token);
        oci_execute($result_for_token);

        $user_id  = "";

        if($row = oci_fetch_assoc($result_for_token)) {
            $user_id = $row['USER_ID'];
        }

        $query_for_customer = "INSERT INTO CUSTOMERS(USER_ID, CUSTOMER_ID) VALUES('$user_id', null)";
        $result_for_customer = oci_parse($connection, $query_for_customer);
        oci_execute($result_for_customer);


        //Mail Requirements
        $sender = $customerEmail;
        $body = "Dear $customerFirstName $customerLastName, Verify it's you";

        include_once "../../../form/mail-format/customer-signup-format.php";
        $subject = get_customer_mail_signup("localhost/website/project/assets/form/signup/customer-signup/verify-customer.php?token=$token");

        $header = "From: brajesh18@tbc.edu.np";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        if (mail($sender, $body, $subject, $header)) {
            $success_msg = "<div class='text-success border border-success p-1 text-center'>
                            <p class='mb-1 p-0'><i class='fas fa-check-circle text-success m-0'></i>&nbsp;Your account has been successfully created.</p>
                            <p class='m-0 p-0'><i class='fas fa-check-circle text-success'></i>&nbsp;To verify your account, please click the verfication link in your email</p>
                        </div>";

        }else {
            $mail_error_msg = "<div class='text-danger border border-danger p-1 text-center'>
                            <p class='mb-1 p-0'><i class='fas fa-times-circle text-danger m-0'></i>&nbsp;Please, try again later.</p>
                            <p class='m-0 p-0'><i class='fas fa-times-circle text-danger'></i>&nbsp;There might be some issue on server configuration.</p>
                        </div>";
        }


    }

}
