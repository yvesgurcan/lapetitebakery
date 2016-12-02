<?php
/*
The dashboard controller prevents non-authenticated users from seeing the content.
*/
defined('BASEPATH') OR exit('No direct script access allowed');

    class Dashboard extends CI_Controller {

        private function _check_if_authenticated() {
            if (!isset($_SESSION['user'])) redirect('login');
        }
        
        public function __construct() {
            parent::__construct();
            $this->_check_if_authenticated();
            $this->load->helper('url');
            $this->load->model('query');
            $this->data['left_menu_sort_order'] = $this->query->left_menu_sort_order();
            $this->data['default_left_menu_sort_order'] = $this->query->default_left_menu_sort_order();
            $this->data['left_menu_glyphs'] = $this->query->left_menu_glyphs();
            $this->data['left_menu_labels'] = $this->query->left_menu_labels();
            $this->data['default_left_menu_labels'] = $this->query->default_left_menu_labels();
            $this->data['left_menu_links'] = $this->query->left_menu_links();
            $this->data['product_count'] = $this->query->get_number_of_products();
            $this->data['category_count'] = $this->query->get_number_of_categories();
            $this->data['category_names'] = $this->query->get_names_of_categories();
            $this->data['current_page'] = basename($_SERVER["SCRIPT_FILENAME"],".php");
            $this->data['work_in_progress'] = "This page is only a placeholder for now. <i>La Petite Bakery</i> is a work in progress :)";
            $this->data['work_in_progress_section'] = "This section is only a placeholder for now. New features coming soon!";
        }

        private function _check_if_file_exists($file) {
            if ( ! file_exists(APPPATH . $file . '.php')) show_404();
        }

        public function index($page = "dashboard") {
            $this->data['current_page'] = $page;
            $this->data['page_title'] = ucwords($page);
            $this->load->view('templates/header',$this->data);
            $this->load->view('dashboard');
            $this->load->view('templates/footer');
        }
        
        public function budget($page = "budget") {
            $this->data['current_page'] = $page;
            $this->data['page_title'] = ucwords($page);
            $this->load->view('templates/header',$this->data);
            $this->load->view('budget');
            $this->load->view('templates/footer');
        }
        
        public function orders($page = "orders") {
            $this->data['current_page'] = $page;
            $this->data['page_title'] = ucwords($page);
            $this->load->view('templates/header',$this->data);
            $this->load->view('orders');
            $this->load->view('templates/footer');
        }

        public function batch($page = "batch maker") {
            $this->data['current_page'] = $page;
            $this->data['page_title'] = ucwords($page);
            $this->load->view('templates/header',$this->data);
            $this->load->view('batch');
            $this->load->view('templates/footer');
        }

        public function products($page = "products") {
            $this->data['current_page'] = $page;
            $this->data['page_title'] = ucwords($page);
            $this->data['products'] = $this->query->get_products();
            $this->load->view('templates/header',$this->data);
            $this->load->view('products');
            $this->load->view('templates/footer');
        }

        public function recipes($page = "recipes") {
            $this->data['current_page'] = $page;
            $this->data['page_title'] = ucwords($page);
            $this->load->view('templates/header',$this->data);
            $this->load->view('recipes');
            $this->load->view('templates/footer');
        }

        public function supplies($page = "supplies") {
            $this->data['current_page'] = $page;
            $this->data['page_title'] = ucwords($page);
            $this->load->view('templates/header',$this->data);
            $this->load->view('supplies');
            $this->load->view('templates/footer');
        }

        public function customers($page = "customers") {
            $this->data['current_page'] = $page;
            $this->data['page_title'] = ucwords($page);
            $this->load->view('templates/header',$this->data);
            $this->load->view('customers');
            $this->load->view('templates/footer');
        }
        

        public function settings($page = "settings") {
            $this->data['current_page'] = $page;
            $this->data['page_title'] = ucwords($page);
            $this->load->view('templates/header',$this->data);
            $this->load->view('settings');
            $this->load->view('templates/footer');
        }
        
        public function logout() {
            session_destroy();
            redirect("login?logout");
        }
    }
?>