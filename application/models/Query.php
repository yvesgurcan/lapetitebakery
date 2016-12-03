<?php
/*
The User model contains the database queries necessary to log in.
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Query extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function auth($username, $password) {
        $this->db->select('*');
        $this->db->from('credentials');
        $this->db->where('user', $username);
        $this->db->where('password', hash('sha256',$password));
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) return $query->result();
        else return false;
    }

    public function get_users() {
        $query = $this->db->get('credentials');
        return $query->result();
    }
    
    public function get_tables() {
        $tables = $this->db->list_tables();
        return $tables;
    }

    public function get_number_of_products() {
        $user = $_SESSION['user'];
        $number_of_products = 'Table products_' . $user . ' does not exist.';
        if ($this->db->table_exists('products_' . $user)) {
            $product_count = $this->db->count_all_results('products_' . $user);
            $number_of_products = "";
            if ($product_count == 0) $number_of_products = "No product were found in the database.";
            else if ($product_count == 1) $number_of_products = $product_count . " product";
            else $number_of_products = $product_count . " products";
        }
        return $number_of_products;
    }

    public function get_number_of_categories() {
        $user = $_SESSION['user'];
        $number_of_categories = '';
        if ($this->db->table_exists('products_' . $user)) {
            $query = $this->db->query('SELECT COUNT(DISTINCT category) FROM products_' . $user);
            $category_count = $query->result_array()[0]['COUNT(DISTINCT category)'];
            $number_of_categories = "";
            if ($category_count == 1) $number_of_categories = $category_count . " category";
            else $number_of_categories = $category_count . " categories";
        }
        return $number_of_categories;
    }

    public function get_names_of_categories() {
        /*$user = $_SESSION['user'];
        $name_of_categories = '';
        if ($this->db->table_exists('products_' . $user)) {
            $query = $this->db->query('SELECT DISTINCT category FROM products_' . $user);
            $name_of_categories_array = $query->result_array();
	    foreach ($name_of_categories_array as $category) {
                    $name_of_categories .= $category . ', ';
                }
	    $name_of_categories = ' (' . rtrim($name_of_categories,', ') . ')'; // trim the comma on the last occurrence
        }
        return $name_of_categories;*/
    }
    
    public function get_products() {
        $user = $_SESSION['user'];
        $products = '';
        if ($this->db->table_exists('products_' . $user)) {
            $query = $this->db->query('SELECT * FROM products_' . $user . ' ORDER BY category DESC');
            $products = $query->result_array();
        }
        return $products;
    }
    
    private function _check_if_user_row_exists($table,$user = default_settings) {
        $user_menu_exists = 0;
        $user_table_name = default_settings;
        $query_if_menu_exist = $this->db->query("SELECT * FROM " . $table . " WHERE user='" . $user. "'");
        if ($query_if_menu_exist->num_rows() === 1) $user_table_name = $user;
        return $user_table_name;
    }

    private function _menu_query($table,$user = default_settings) {
        $this->query = $this->db->query("SELECT menu1,menu2,menu3,menu4,menu5,menu6,menu7,menu8 FROM " . $table . " WHERE user='" . $user . "'");
        $result = $this->query->result_array()[0];
        return $result;
    }

    public function default_left_menu_sort_order() {
        $table = "menu_sort";
        $result = $this->_menu_query($table);
        return $result;
    }

    public function default_left_menu_labels() {
        $table = "menu_labels";
        $result = $this->_menu_query($table);
        return $result;
    }
    
    public function left_menu_sort_order() {
        $table = "menu_sort";
        $user = $this->_check_if_user_row_exists($table,$_SESSION['user']);
        $result = $this->_menu_query($table,$user);
        return $result;
    }

    public function left_menu_glyphs() {
        $table = "menu_glyphs";
        $result = $this->_menu_query($table);
        return $result;
    }

    public function left_menu_labels() {
        $table = "menu_labels";
        $user = $this->_check_if_user_row_exists($table,$_SESSION['user']);
        $result = $this->_menu_query($table,$user);
        return $result;
    }

    public function left_menu_links() {
        $table = "menu_links";
        $user = $this->_check_if_user_row_exists($table,$_SESSION['user']);
        $result = $this->_menu_query($table,$user);
        return $result;
    }
    
}
?>
