<?php
/*
The admin controller is for pages intended to be seen only by the developer. Any user that is not logged in or does not have the right access level will be redirected respectively to the login page or the dashboard page.
*/
defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin extends CI_Controller {
        
        private function _check_if_dev_access() {
            if (!isset($_SESSION['user'])) redirect('login');
            else if ($_SESSION['access_level'] < developer_access) redirect('dashboard');
        }
        
        public function __construct() {
            parent::__construct();
            $this->_check_if_dev_access();
            $this->load->helper('url');
            $this->load->model('query');
            $this->data['left_menu_sort_order'] = $this->query->left_menu_sort_order();
            $this->data['default_left_menu_sort_order'] = $this->query->default_left_menu_sort_order();
            $this->data['left_menu_glyphs'] = $this->query->left_menu_glyphs();
            $this->data['left_menu_labels'] = $this->query->left_menu_labels();
            $this->data['default_left_menu_labels'] = $this->query->default_left_menu_labels();
            $this->data['left_menu_links'] = $this->query->left_menu_links();
            $this->data['current_page'] = basename($_SERVER["SCRIPT_FILENAME"],".php");
            $this->data['work_in_progress'] = "This page is only a placeholder for now. <i>La Petite Bakery</i> is a work in progress :)";
            $this->data['work_in_progress_section'] = "This section is only a placeholder for now. New features coming soon!";
        }

        private function _check_if_file_exists($file) {
            if (!file_exists(APPPATH . "views/" . $file . '.php')) show_404();
        }
        
        public function index() {
            $this->data['current_page'] = "users";
            $this->data['page_title'] = ucwords("user accounts");
            $this->data['users'] = $this->query->get_users();
            $this->load->view('templates/header',$this->data);
            $this->load->view('admin/users');
            $this->load->view('templates/footer');
        }
        
        public function users() {
            $this->index();
        }
       
        public function server($menu = 'settings') {
            $this->data['current_page'] = $menu;
            $this->_check_if_file_exists('admin/server/' . $menu);
            $this->data['page_title'] = ucwords("Server " . $menu);
            $this->load->view('templates/header',$this->data);
            $this->load->view('admin/server/' . $menu);
            $this->load->view('templates/footer');
        }
 
        public function database($menu = 'query') {
            $this->data['current_page'] = $menu;
            $this->_check_if_file_exists('admin/database/' . $menu);
            $this->data['page_title'] = ucwords("Database " . $menu);
            $this->data['tables'] = $this->query->get_tables();
            $this->load->view('templates/header',$this->data);
            $this->load->view('admin/database/' . $menu);
            $this->load->view('templates/footer');
        }
       
   }
?>