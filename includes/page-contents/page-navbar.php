<?php

session_start();

//Connect to Database
$connection = oci_connect("RAJES", "David_123", "//localhost/xe");

if (!$connection) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}


//Select all the trader types of trader
$query = "SELECT * FROM TRADERS";
$result = oci_parse($connection, $query);
oci_execute($result);
?>

<!--Navbar Section-->
<nav class="navbar navbar-expand-lg position-relative">
    <!--Logo-->
    <a class="navbar-brand position-relative" href="/website/project/homepage.php">
        <img src="/website/project/images/homepage/logo/logo.png" class="ml-3" alt=""/>
    </a>
    <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown"
            aria-expanded="false"
            aria-label="Toggle navigation"
    >
        <svg
                xmlns="http://www.w3.org/2000/svg"
                class="icon icon-tabler icon-tabler-align-justified"
                width="35"
                height="35"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="#15c0a6"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
        >
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <line x1="4" y1="6" x2="20" y2="6"/>
            <line x1="4" y1="12" x2="20" y2="12"/>
            <line x1="4" y1="18" x2="16" y2="18"/>
        </svg>
    </button>

    <!--Navbar Items-->
    <div class="collapse navbar-collapse mr-0" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto mr-5 font-rale">
            <li class="nav-item active mx-3">
                <a class="nav-link" href="/website/project/homepage.php"
                >Home <span class="sr-only">(current)</span></a
                >
            </li>

            <li class="nav-item mx-3 dropdown">
                <a class="nav-link" href="#" data-toggle="dropdown">
                    Shops
                    <i class="fas fa-chevron-down mx-1"></i>
                </a>
                <div class="dropdown-menu">

                    <?php
                    while ($row = oci_fetch_assoc($result)) { ?>
                        <a class="dropdown-item"
                           href="/website/project/trader-types/<?php echo $row['TRADER_TYPE'] ?>/<?php echo $row['TRADER_TYPE'] ?>.php"><?php echo ucfirst($row['TRADER_TYPE']); ?></a>
                    <?php } ?>

            <li class="nav-item mx-3">
                <a href="/website/project/more-page/about-us/about-us.php" class="nav-link">About Us</a>
            </li>

            <?php if ((isset($_SESSION['user']))) { ?>

                <li class="nav-item mx-3">
                    <!--Provide Link for Sign Up-->
                    <a href="#" class="nav-link nav-link-item"><i style="font-size: 1.5rem" class="fas fa-user text-warning"></i></a>
                </li>


            <?php } else { ?>

                <li class="nav-item mx-3">
                    <a class="nav-link" href="/website/project/form/signin/signin.php">Login</a>
                </li>

                <li class="nav-item mx-3">
                    <a href="/website/project/form/signup/customer-signup/customer-signup.php"
                       class="nav-link nav-link-item">Sign Up</a>
                </li>

            <?php } ?>

            <li class="nav-item mx-3">
                <a href="#" class="nav-link cart rounded">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="mx-2">0</span>
                </a>
            </li>
        </ul>
    </div>
</nav>