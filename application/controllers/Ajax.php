<?php
/*
The Ajax controller redirects form submits
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
    class Ajax extends CI_Controller {
 
        function __construct() {
            parent::__construct();
            $this->data['current_page'] = basename($_SERVER["SCRIPT_FILENAME"],".php");
            $this->load->helper('url');
            $this->load->model('query');/*
            if (empty($_POST)) {
                if (!isset($_SESSION['user'])) redirect('login');
                else redirect('dashboard');
            }*/
        }

        public function save_users() {
            $user = $this->input->post('user');
            $access = $this->input->post('access');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $id = $this->input->post('id');
            $number_of_users = count($user);
            $table_rows = $this->db->count_all_results('credentials');
            for ($i = 0; $i < $number_of_users; $i++) {
            // if all fields (except for passwords) are non-empty...
            if ($user[$i] != "" && $access[$i] != "" && $email[$i] != "") {
                // if password is not empty either, then set a new password with the hash
                $password_query = "";
                if ($password[$i] != "") {
                    $password_query = " ,password='" . hash("sha256",$password[$i]) . "' ";
                }

                // update preexisting users
                if ($i < $table_rows) {
                    $this->db->query("UPDATE credentials SET user='" . $user[$i] . "',access=" . $access[$i] . ",email='" . $email[$i] . "' " . $password_query . " WHERE id=" . $id[$i] . " LIMIT 1");
                    // $stmt = SimpleQuery($query);
                }
                
                else {
                    // create a row for new users
                    if ($password[$i] != "") {
                    $this->db->query("INSERT INTO credentials (user,access,email,password) VALUES ('" . $user[$i] . "'," . $access[$i] . ",'" . $email[$i] . "','" . hash("sha256",$password[$i]) . "')");
                    //$stmt = SimpleQuery($query);
                    }
                    // don't forget to set a password!
                    else {
                        echo "Error: You must enter a password for user <i>" . $user[$i] . "</i>.<br>";
                    }
                }
            }
            // if the user data is empty in the POST, delete the row in the database
            else if ($i < $table_rows) {
                echo "User <i>" . $user[$i] . "</i> was deleted.";
                $this->db->query("DELETE FROM credentials WHERE id=" . $id[$i]);
                // $stmt = SimpleQuery($query);
            }
            // if only some of the field are complete
            else if ($i >= $table_rows && !($user[$i] == "" && $access[$i] == "" && $email[$i] == "")) {
                echo "Error: All fields are required to create a new user (row #" . ($i+1) . ").";
            }
        }
            
        }
        
        public function dynamic_query() {
            $user_query = $this->input->post('db_query');
            $query = $this->db->query($user_query);
            
            $this->data['dynamic_query'] = $user_query;
            $this->data['output'] = $query->result();
            $this->load->view("admin/database/query_output",$this->data);
        }
        
        public function setup_database() {
            // creates the credentials table
        $credentials_query = "DROP TABLE IF EXISTS credentials";
        $this->db->query($credentials_query);

        $credentials_query = "CREATE TABLE credentials (id int auto_increment primary key,user text,password text,access text,email text)";
        $this->db->query($credentials_query);

        // creates a superuser
        $superuser_query = "INSERT INTO credentials VALUES (1,'superuser','" . hash("sha256","superuser") . "',4,'gurcan.yves@gmail.com')";
        $this->db->query($superuser_query);

        // creates a demo user
        $demo_query = "INSERT INTO credentials VALUES (2,'demo','" . hash("sha256","demo") . "',2,'gurcan.yves@gmail.com')";
        $this->db->query($demo_query);

        // display username
        $superuser_query = "SELECT * FROM credentials";
        $superuser_output = $this->db->query($superuser_query);
        foreach($superuser_output->result_array() as $row) {
            echo "<div>A new user was created: <i>" . $row['user'] . "</i>. Password is the same as username.</div>";
        }

        // creates a product table
        $products_query = "DROP TABLE IF EXISTS products_superuser";
        $this->db->query($products_query);

        $products_query = "CREATE TABLE products_superuser (id int auto_increment primary key,name text,plural text,category text,price decimal, min integer, max integer, description text, image_url text, shelf_life text, availability text, season_start date, season_end date)";
        $this->db->query($products_query);

        // add some products to the table
        $croissant_query = "INSERT INTO products_superuser VALUES (1,'Croissant','Croissants','Pastry',2.75,6,100,'Croissant [krwa-san] is the classic French viennoiserie [vyen-wahz-ree]. Flaky and generous, this pastry is made from a dough laminated with Tillamook butter and folded multiple times. Made from scratch, it takes no less than 24 hours to give our croissants their generous shape.','http://static1.squarespace.com/static/555a5b0fe4b0caee065a59c6/5580a345e4b095c5b4d7b991/5580a353e4b095c5b4d7b9e9/1434493869224/?format=500w','1 day','always',0,0)";
        $this->db->query($croissant_query);

        $croissant_amandes_query = "INSERT INTO products_superuser VALUES (2,'Croissant aux amandes','Croissants aux amandes','Pastry',3.25,6,100,'Croissant aux amandes [krwa-san oh ah-mand] is a delicious variation on our butter croissant. In addition to its incredible flakiness, this viennoiserie contains frangipane, a tasty almond-filling made of almond meal, butter, and sugar.','https://static1.squarespace.com/static/555a5b0fe4b0caee065a59c6/5580a345e4b095c5b4d7b991/558caab8e4b09afe2af07a28/1435282114399/IMG_6620.JPG?format=500w','1 day','always',0,0)";
        $this->db->query($croissant_amandes_query);

        $brioche_query = "INSERT INTO products_superuser VALUES (3,'Brioche pur beurre','Brioches pur beurre','Sweet Bread',3.25,6,100,'Brioche [bree-ohsh] is the favorite sweet bread of the French. Exceptionally fluffy, brioche is ideal for breakfast, whether plain or spread with jam or butter! Our 600-gram loaf stays fresh for multiple days.','https://static1.squarespace.com/static/555a5b0fe4b0caee065a59c6/5580a345e4b095c5b4d7b991/5580b466e4b0619f930992cf/1434502717639/Brioche+3.JPG?format=500w','5 days','seasonal',2017-03-01,2017-06-01)";
        $this->db->query($brioche_query);

        $galette_query = "INSERT INTO products_superuser VALUES (4,'Galette des rois','Galettes des rois','Cake',16,1,10,'Galette [ga-let] (also know as king cake) is a traditional pie eaten on the day of the Epiphany (January 6) every year in France. Made of pastry dough and frangipane (like the croissant aux amandes), the galette des rois is even better shared with your friends and loved ones (serves 6 persons).','https://static1.squarespace.com/static/555a5b0fe4b0caee065a59c6/5580a345e4b095c5b4d7b991/5580b44ce4b0619f93099254/1434502717618/Galette+des+rois+1.JPG?format=500w','5 days','seasonal',2016-12-01,2017-01-01)";
        $this->db->query($galette_query);

        $gfbaguette_query = "INSERT INTO products_superuser VALUES (5,'Gluten-free baguette','Gluten-free baguettes','Bread',4.50,1,20,'We experimented with various ingredients in collaboration with friends with Celiac disease in order to create a perfect baguette sans gluten [ba-get san glu-ten]. Our GF bread might surprise you: despite its amazing taste and consistency, it is indeed free of any gluten! However, please note that we use egg white. We also top the baguette with sesame seeds (so please let us know if you do not want them).','https://static1.squarespace.com/static/555a5b0fe4b0caee065a59c6/5580a345e4b095c5b4d7b991/5580cfd5e4b051888f7b1cc8/1434505182542/IMG_5944.JPG?format=500w','2 days','always',0,0)";
        $this->db->query($gfbaguette_query);

        // creates and populates menu tables
        // menu_links
        $menu_links_query = "DROP TABLE IF EXISTS menu_links";
        $this->db->query($menu_links_query);

        $menu_links_query = "CREATE TABLE menu_links (id int auto_increment primary key, user text, menu1 text, menu2 text, menu3 text, menu4 text, menu5 text, menu6 text, menu7 text, menu8 text)";
        $this->db->query($menu_links_query);

        $menu_links_query = "INSERT INTO menu_links VALUES (1, 'default', 'dashboard', 'budget', 'orders', 'batch', 'products', 'recipes', 'supplies', 'customers')";
        $this->db->query($menu_links_query);

        // menu_glyphs
        $menu_glyphs_query = "DROP TABLE IF EXISTS menu_glyphs";
        $this->db->query($menu_glyphs_query);

        $menu_glyphs_query = "CREATE TABLE menu_glyphs (id int auto_increment primary key, user text, menu1 text, menu2 text, menu3 text, menu4 text, menu5 text, menu6 text, menu7 text, menu8 text)";
        $this->db->query($menu_glyphs_query);

        $menu_glyphs_query = "INSERT INTO menu_glyphs VALUES (1, 'default', 'glyphicon-dashboard', 'glyphicon-piggy-bank', 'glyphicon-shopping-cart', 'glyphicon-cutlery', 'glyphicon-ice-lolly-tasted', 'glyphicon-book', 'glyphicon-grain', 'glyphicon-user')";
        $this->db->query($menu_glyphs_query);

        // menu_labels
        $menu_labels_query = "DROP TABLE IF EXISTS menu_labels";
        $this->db->query($menu_labels_query);

        $menu_labels_query = "CREATE TABLE menu_labels (id int auto_increment primary key, user text, menu1 text, menu2 text, menu3 text, menu4 text, menu5 text, menu6 text, menu7 text, menu8 text)";
        $this->db->query($menu_labels_query);

        $menu_labels_query = "INSERT INTO menu_labels VALUES (1, 'default', 'Dashboard', 'Budget', 'Orders', 'Batch Maker', 'Products', 'Recipes', 'Supplies', 'Customers')";
        $this->db->query($menu_labels_query);

        $menu_labels_query = "INSERT INTO menu_labels VALUES (2, 'superuser', 'Dashboard', '', 'Orders', 'Batch Maker', 'Products', 'Recipes', '', 'Customers')";
        $this->db->query($menu_labels_query);

        $menu_labels_query = "INSERT INTO menu_labels VALUES (3, 'demo', 'Dashboard', 'Budget', 'Orders', '', 'Products', '', 'Supplies', 'Customers')";
        $this->db->query($menu_labels_query);

        // menu_sort
        $menu_sort_query = "DROP TABLE IF EXISTS menu_sort";
        $this->db->query($menu_sort_query);

        $menu_sort_query = "CREATE TABLE menu_sort (id int auto_increment primary key, user text, menu1 text, menu2 text, menu3 text, menu4 text, menu5 text, menu6 text, menu7 text, menu8 text)";
        $this->db->query($menu_sort_query);

        $menu_sort_query = "INSERT INTO menu_sort VALUES (1, 'default', 1, 2, 3, 4, 5, 6, 7, 8)";
        $this->db->query($menu_sort_query);

        $menu_sort_query = "INSERT INTO menu_sort VALUES (2, 'superuser', 1, 7, 3, 2, 5, 6, 8, 4)";
        $this->db->query($menu_sort_query);

        $menu_sort_query = "INSERT INTO menu_sort VALUES (3, 'demo', 8, 1, 3, 7, 6, 8, 5, 2)";
        $this->db->query($menu_sort_query);
            
        echo "It looks like everything went well. You can now <a href='" . base_url() . "'>login</a>.";
        }
        
    }
?>