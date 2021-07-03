<?php

if(isset($_SESSION['trader'])) { ?>

    <!--Panel Column-->
    <div class="col-xl-2 p-0">
        <!--Sidebar Section-->
        <div class="sidebar-container">
            <nav class="menubar w-100">
                <ul class="nav d-flex flex-column">
                    <li class="nav-item head-panel">
                        <a href="#" class="nav-link active"><i class="fas fa-user-cog"></i>Trader Panel</a>
                    </li>

                    <li class="nav-item panel-links">
                        <a href="#" class="nav-link d-inline-block">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard</a>
                    </li>

                    <li class="nav-item panel-links">
                        <a href="/website/project/panels/trader-panel/profile/trader-profile.php" class="nav-link d-inline-block">
                            <i class="fas fa-user-circle"></i>
                            Profile</a>
                    </li>

                    <li class="nav-item panel-links">
                        <a href="/website/project/panels/trader-panel/crud-product/addproduct/addproduct.php" class="nav-link d-inline-block">
                            <i class="fas fa-plus-circle"></i>
                            Add Products</a>
                    </li>

                    <li class="nav-item panel-links">
                        <a href="/website/project/panels/trader-panel/crud-product/displayproduct/displayproduct.php" class="nav-link d-inline-block">
                            <i class="fas fa-tv"></i>
                            Display Product</a>
                    </li>

                    <li class="nav-item panel-links">
                        <a href="/website/project/panels/trader-panel/offers/displayoffer/displayoffer.php" class="nav-link d-inline-block">
                            <i class="fas fa-gift"></i>
                            Offers</a>
                    </li>

                    <li class="nav-item panel-links">
                        <a href="/website/project/panels/trader-panel/offers/addoffer/addoffer.php" class="nav-link d-inline-block">
                            <i class="fas fa-plus-circle"></i>
                            Add Offers</a>
                    </li>

                    <li class="nav-item panel-links">
                        <a href="/website/project/homepage.php" class="nav-link d-inline-block">
                            <i class="fas fa-arrow-circle-left"></i>
                            Back to site</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


<?php }else if(isset($_SESSION['admin_as_trader'])) { ?>

    <!--Panel Column-->
    <div class="col-xl-2 p-0">
        <!--Sidebar Section-->
        <div class="sidebar-container">
            <nav class="menubar w-100">
                <ul class="nav d-flex flex-column">
                    <li class="nav-item head-panel">
                        <a href="#" class="nav-link active"><i class="fas fa-user-cog"></i>Trader Panel</a>
                    </li>

                    <li class="nav-item panel-links">
                        <a href="#" class="nav-link d-inline-block">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard</a>
                    </li>

                    <li class="nav-item panel-links">
                        <a href="/website/project/panels/trader-panel/profile/trader-profile.php" class="nav-link d-inline-block">
                            <i class="fas fa-user-circle"></i>
                            Profile</a>
                    </li>

                    <li class="nav-item panel-links">
                        <a href="/website/project/panels/trader-panel/crud-product/displayproduct/displayproduct.php" class="nav-link d-inline-block">
                            <i class="fas fa-tv"></i>
                            Display Product</a>
                    </li>

                    <li class="nav-item panel-links">
                        <a href="/website/project/panels/trader-panel/offers/displayoffer/displayoffer.php" class="nav-link d-inline-block">
                            <i class="fas fa-gift"></i>
                            Offers</a>
                    </li>


                    <li class="nav-item panel-links">
                        <a href="/website/project/homepage.php" class="nav-link d-inline-block">
                            <i class="fas fa-arrow-circle-left"></i>
                            Back to site</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


<?php } ?>

