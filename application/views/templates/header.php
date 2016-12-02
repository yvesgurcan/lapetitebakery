<html>
    <head>
        <title>LPB - <?=$page_title?></title>
        <base href="<?= site_url() ?>" />
        <!-- jQuery -->
        <script src="assets/jquery-3.1.1.min.js"></script>
        <!-- jQuery UI -->
        <script src="assets/jquery-ui.min.js"></script>
        <!-- Moment.js -->
        <script src="assets/moment.min.js"></script>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="assets/bootstrap/bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <script src="assets/bootstrap/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <!-- custom CSS -->
        <link rel="stylesheet" href="assets/style.css">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="en" http-equiv="Content-language">
        <meta content="text/html; charset=UTF-8" http-equiv="Content-type">

        <!-- PHP variables passed to javascript -->
        <script type='text/javascript'>
            devmode = <?=json_encode(defined('DEVMODE'))?>;
            database_connection = true // find a way to notify the user when DB is down
        </script>

    </head>
    <body>
        <!-- top navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top no-border">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <!-- navbar header -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="dashboard">La Petite Bakery</a>
                        <!-- small screen navbar menu -->
                        <div class="navbar-toggle" data-toggle="collapse" data-target=".collapsible-menu"><span class="glyphicon glyphicon-menu-hamburger"></span></div>
                    </div>
<?php
    if (!empty($_SESSION) && !empty($_SESSION['access_level'] )) {
?>
                    <!-- navbar menu -->
                    <div class="navbar-right navbar-collapse collapse collapsible-menu">
                        <ul class="nav navbar-nav">
<?php
        // display the developer utilities menu if user has the right access level
        if ($_SESSION['access_level'] >= developer_access) {
?>
                            <!-- developer dropdown menu -->
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Developer <span class="glyphicon glyphicon-flash"></span></a>
                                <ul class="dropdown-menu navbar-inverse">
                                    <li class="dropdown-header">Server</li>
                                    <li><a href="admin/server/settings">Server Settings</a></li>
                                    <li><a href="admin/server/session">Current Session</a></li>
                                    <li><a href="admin/server/editpages">File Writer</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header">Database</li>
                                    <li><a href="admin/users">Users</a></li>
                                    <li><a href="admin/database/query">Query Database</a></li>
                                    <li><a href="admin/database/deploy">Export/Import Database</a></li>
                                    <li><a href="<?=PHPMYADMIN?>" target="_blank">PHPMyAdmin</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header">Web Host</li>
                                    <li><a href="<?=CONTROL_PANEL?>" target="_blank">Control Panel</a></li>
                                    <li><a href="admin/server/phpversion">PHP Version</a></li>
                                </ul>
                            </li>
<?php
        }
?>
                            <!-- links dropdown menu -->
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Links <span class="glyphicon glyphicon-globe"></span></a>
                                <ul class="dropdown-menu navbar-inverse">
                                    <li class="dropdown-header">Google Apps</li>
                                    <li><a href='http://gmail.com' target='_blank'>Gmail</a></li>
                                    <li><a href='http://drive.google.com' target='_blank'>Google Drive</a></li>
                                    <li><a href='http://calendar.google.com' target='_blank'>Google Calendar</a></li>
                                    <li class="divider"></li>
                                    <li><a href='http://squareup.com' target='_blank'>Square</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header">Baking Utilities</li>
                                    <li><a href='https://docs.google.com/spreadsheets/d/1uHj4H0vHLopKd22V2a01NMbdYi9BvdHnQp5uzNJ3K0c/edit#gid=0' target='_blank'>Baking Log</a></li>
                                    <li><a href='https://www.google.com/#q=stopwatch' target='_blank'>Stopwatch</a></li>
                                </ul>
                            </li>
                            <!-- user settings menu link -->
                            <li><a href="dashboard/settings">Settings <span class="glyphicon glyphicon-cog"></span></a></li>
                            <!-- logout menu link -->
                            <li class="btn-danger logout"><a class="logout" href="logout">Logout <span class="glyphicon glyphicon-log-out"></span></a></li>
                        </ul>
                    </div>
                </div>
<?php
    }
?>
            </div>
        </nav>
        <!-- top navbar spacer -->
        <div id="upper-navbar-spacer"></div>
<?php
    if ($current_page != "index") {
?>
        <!-- left navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-left">
            <!-- small screen navbar menu -->
            <div class="navbar-header">
                <div class="navbar-brand navbar-left" hidden>Menu</div>
                <div class="navbar-toggle" data-toggle="collapse" data-target=".collapsible-menu-left"><span class="glyphicon glyphicon-menu-hamburger"></span></div>
            </div>
            <!-- navbar menu (draggable) -->
            <div class="navbar-collapse collapse collapsible-menu-left">
                <ul class="nav navbar-nav nav-left sortable">
<?php
        // fetch left menu from database
        if (!empty($_SESSION['access_level'])) {
            if ($_SESSION['access_level'] >= user_access)

            // display menu items
            for ($i = 1; $i <= count($left_menu_labels); $i++) {
                // if the label is empty, it means that user does not want this menu to be displayed
                if ($left_menu_labels['menu' . $left_menu_sort_order['menu' . $i]] != "") {
                    // add the "active" HTML class to the element if menu link coincides with $current_page
                    $active = "";
                    if ($left_menu_links['menu' . $left_menu_sort_order['menu' . $i]] == $current_page) $active = "active";
?>
                    <li class="nav-item <?=$active?>"><a href="dashboard/<?=$left_menu_links['menu' . $left_menu_sort_order['menu' . $i]]?>"><?=$left_menu_labels['menu' . $left_menu_sort_order['menu' . $i]]?> <span class="glyphicon <?=$left_menu_glyphs['menu' . $left_menu_sort_order['menu' . $i]]?>"></span></a></li>
<?php
                }
            }
        }
?>
                </ul>
            </div>
        </nav>
        <!-- left navbar spacer -->
        <div id="left-navbar-spacer">
<?php
    }
?>
        <!-- main content wrapper -->
        <div class="container-fluid" id="page">
            <!-- form submit feedback messages -->
            
            <div class="row">
                <div class="col-sm-12">
                    <div id="feedback" hidden></div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <!-- form submit feedback messages with detailed info/debug -->
                    <div id="error_feedback_wrapper" class="alert alert-info alert-submit text-center" hidden><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <div id="error_feedback"></div>
                    </div>
                    <div id="db_feedback"></div>
                </div>
            </div>
            <!-- main content -->
