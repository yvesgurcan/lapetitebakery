<?php
    // database
/*
    if ($pdo) {

        // check if user preferences exist for the display of the menu
        $query_exists = "SELECT EXISTS (SELECT * FROM menu_sort WHERE user='" . $_SESSION['user']. "')";
        $stmt_exists = SimpleQuery($query_exists);
        $exist = 0; // default is false
        foreach ($stmt_exists as $row) {
            $exist = $row[0][0]; // becomes true if a table exists
        }
        $username = "default";
        if ($exist) $username = $_SESSION['user'];

        // load default settings
        $query = "SELECT * FROM menu_labels WHERE user='" . default_settings . "'";
        $stmt = SimpleQuery($query);
        foreach ($stmt as $row) {
            $default_menu = array($row['menu1'],$row['menu2'],$row['menu3'],$row['menu4'],$row['menu5'],$row['menu6'],$row['menu7'],$row['menu8']);
        }
        
        // load user preferences (menu_labels)
        $query = "SELECT * FROM menu_labels WHERE user='" . $username . "'";
        $stmt = SimpleQuery($query);
        foreach ($stmt as $row) {
            $menu = array($row['menu1'],$row['menu2'],$row['menu3'],$row['menu4'],$row['menu5'],$row['menu6'],$row['menu7'],$row['menu8']);
        }
        // load user preferences (menu_sort)
        $query = "SELECT * FROM menu_sort WHERE user='" . $username . "'";
        $stmt = SimpleQuery($query);
        foreach ($stmt as $row) {
            $menu_sort = array($row['menu1'],$row['menu2'],$row['menu3'],$row['menu4'],$row['menu5'],$row['menu6'],$row['menu7'],$row['menu8']);
        }
    }*/
?>    
            <div class="row">
                <div class="col-sm-12">
                    <h2>Your Settings</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3>Menu</h3>
                    <!-- TODO: save position of menus to the database dynamically -->
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form>
                        <div class="sortable-free">
<?php
    // display all menu items in draggable DIVs
    for ($i = 1; $i <= count($default_left_menu_labels); $i++) {
            $checked = "";
            // if user has marked the menu item as visible, check the entry
            if ($left_menu_labels['menu' . $left_menu_sort_order['menu' . $i]] == $default_left_menu_labels['menu' . $left_menu_sort_order['menu' . $i]]) {
                $checked = 'checked';
            }
?>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 sortable-menu"><input type="checkbox" <?=$checked?> class="form-check-input"> <label><?=$default_left_menu_labels['menu' . $default_left_menu_sort_order['menu' . $i]]?></label></div>
<?php
    }
?>                                                    
                            
                            </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                </div>
            </div>
        
            <div class="row">
                <div class="col-sm-12">
                    <h3>Links</h3>
                    <!-- TODO: allow user to enter their own links to display on the top menu -->
                    <?=$work_in_progress_section?>
                </div>
            </div>