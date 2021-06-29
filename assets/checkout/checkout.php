<?php

session_start();

if(isset($_SESSION['user'])) {

}else {
    header('Location: /website/project/assets/form/signin/signin.php?message=login');
}