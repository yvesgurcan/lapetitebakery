<?php

    // create a welcome message
    $welcome = "Bienvenue, " . ucfirst($_SESSION['user']);
    // create a special welcome message for demo users
    if ($_SESSION['access_level'] == "2") {
        $welcome = "Welcome to the demo of <i>La Petite Bakery</i>";
    }
    // just in case the user name is an empty value
    else if ($_SESSION['user'] == "") {
        $welcome = "Bienvenue !";
    }
?>
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="border"><?=$welcome?></h1>
                </div>
                <div class="col-sm-12">
                    <h2>Next Delivery</h2>
                </div>
                <div class="col-sm-12">
                    <!-- TODO: hookup to the Google Calendar API to display the user's schedule -->
                    <?=$work_in_progress_section?>
                </div>
                <div class="col-sm-12">
                    <h2>Last Order</h2>
                </div>
                <div class="col-sm-12">
                    <!-- TODO: consult the database and fetch data about the last order that was placed -->
                    <?=$work_in_progress_section?>
                </div>
                <div class="col-sm-12">
                    <h2>Products</h2>
                </div>
                <div class="col-sm-12">
                    <div><b><?=$product_count?></b></div>
                    <div><b><?=$category_count?></b><span class=category_names hidden><?=$product_category_names?></span></div>
                    <!-- TODO: provide a summary of the products offered by the business -->
                    <?=$work_in_progress_section?>
                </div>
            </div>