<?php
/*
The login controller allows user to authenticate.
*/
defined('BASEPATH') OR exit('No direct script access allowed');

    class Login extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->helper('url');
            $this->data['current_page'] = basename($_SERVER["SCRIPT_FILENAME"],".php");
        }
        

        private function _check_if_authenticated() {
            if (isset($_SESSION['user'])) redirect('dashboard');
        }
        
        public function index() {
            $this->_check_if_authenticated();
            $this->data['page_title'] = ucwords("la petite bakery");
            $this->load->view('templates/header',$this->data);
            $this->load->view('login');
            $this->load->view('templates/footer');
        }
        

    }
?>