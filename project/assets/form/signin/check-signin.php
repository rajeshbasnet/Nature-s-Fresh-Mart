<?php

session_start();

include_once "../form-functions.php";
include_once "../../trader-types/functions.php";

$connection = getConnection();

if (isset($_POST['form-submit'])) {

    $user = $_POST['user-type'] ??= "";
    $email = $_POST['user-email'] ??= "";
    $password = $_POST['user-password'] ??= "";

    //Sanitizing values
    $user = htmlspecialchars(trim($user));
    $email = htmlspecialchars(trim($email));
    $password = htmlspecialchars(trim($password));

    //Error
    $errors = [];
    $success = "";

    if (!empty($user) && !empty($email) && !empty($password)) {

        $hashed_password = md5($password);

        $result = check_login(strtoupper($user), $email, $hashed_password, $connection);

        if ($result['result'] === true) {

            if ($user == 'customers') {
                $user_id = $result['id'];
                $customer_id = get_user_type_id($user_id, $connection, "CUSTOMERS");

                $basket_token = "";

                try {
                    $basket_token = bin2hex(random_bytes(25));
                } catch (Exception $exception) {

                    $random_value = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

                    for ($i = 0; $i < 20; $i++) {
                        $rand = rand(0, (strlen($random_value) - 1));
                        $basket_token .= $random_value[$rand];
                    }
                }

                insert_into_basket($customer_id, $basket_token, $connection);

                $_SESSION['basket_token'] = $basket_token;
                $_SESSION['user'] = $result['id'];



            } elseif ($user == 'traders') {
                $_SESSION['trader'] = $result['id'];

            } elseif ($user == 'admin') {
                $_SESSION['admin'] = $result['id'];
            }






            $success = "<div class='text-success border border-success p-1 text-center'>
                            <p class='mb-1 p-1'><i class='fas fa-check-circle text-success m-0'></i>&nbsp;Great, you have been successfully logged in.</p>
                            <p class='m-0 p-1'><i class='fas fa-check-circle text-success'></i>&nbsp;Please wait, you will be redirected to homepage automatically.</p>
                        </div>";

            ?>

            <script>

                setTimeout(() => {
                    window.location.href = "/website/project/homepage.php";
                }, 1500);
            </script>

            <?php

        } else {
            $errors['login'] = "<p class='text-danger text-center border border-danger p-1 m-0 w-75 mx-auto font-rubik'><i class='text-danger fas fa-times-circle'></i>&nbsp;Sorry, your username or password is invalid.</p>";
        }

    } else {
        $errors['login'] = "<p class='font-rubik border border-danger w-75 mx-auto text-danger p-2 m-0 d-flex align-items-center justify-content-center'><i class='text-danger fas fa-times-circle'></i>&nbsp;ERROR : NON OF THE FIELD SHOULD BE LEFT EMPTY</p>";
    }

}