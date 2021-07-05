<?php

session_start();

include_once "../connection/connect.php";
$connection = getConnection();

include_once "../assets/trader-types/functions.php";
delete_basket_using_total_sum($connection);

if(isset($_SESSION['user']) || isset($_SESSION['trader']) || isset($_SESSION['admin'])) {
    session_unset();
    session_destroy();
    header('Location: /website/project/homepage.php?logged=out');
}else {
    header('Location: /website/project/homepage.php');
}