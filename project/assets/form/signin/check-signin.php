<?php

session_start();

include_once "../form-functions.php";

$connection = getConnection();

if(isset($_POST['form-submit'])) {

    $user = $_POST['user-type'] ??= "";
    $email = $_POST['user-email'] ??= "";
    $password = $_POST['user-password'] ??= "";

    //Sanitizing values
    $user= htmlspecialchars(trim($user));
    $email = htmlspecialchars(trim($email));
    $password = htmlspecialchars(trim($password));

    //Error
    $errors = [];
    $success = "";

    if(!empty($user) && !empty($email) && !empty($password)) {

        if($user === 'customers') {
            $hashed_password = md5($password);

            $result = check_login(strtoupper($user), $email, $hashed_password, $connection);

            if($result['result'] === true) {

                $success = "<div class='text-success border border-success p-1 text-center'>
                            <p class='mb-1 p-1'><i class='fas fa-check-circle text-success m-0'></i>&nbsp;Great, you have been successfully logged in.</p>
                            <p class='m-0 p-1'><i class='fas fa-check-circle text-success'></i>&nbsp;Please wait, you will be redirected to homepage automatically.</p>
                        </div>";

                ?>

                <script>

                    setTimeout(() => {
                        window.location.href="/website/project/homepage.php";
                    }, 1500);
                </script>

                <?php $_SESSION['user'] = $result['id'];

            }else {
                $errors['login'] = "<p style='font-size: 1.2rem border-width: 2px !important;' class='text-danger border border-danger p-1 m-0 d-flex align-items-center justify-content-center font-rubik'><i class='text-danger fas fa-times-circle'></i>&nbsp;Sorry, your username or password is invalid.</p>";
            }
        }

    }else {
        $errors['login'] = "<p style='font-size: 1.2rem; border-width: 2px !important;' class='font-rubik border border-danger text-danger p-1 m-0 d-flex align-items-center justify-content-center'><i class='text-danger fas fa-times-circle'></i>&nbsp;Sorry, none of the field should be empty</p>";
    }

}