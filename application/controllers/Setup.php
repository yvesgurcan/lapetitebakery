<?php
/*
The admin controller is for pages intended to be seen only by the developer. Any user that is not logged in or does not have the right access level will be redirected respectively to the login page or the dashboard page.
*/
defined('BASEPATH') OR exit('No direct script access allowed');

    class Setup extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
            $this->load->helper('url');
            $this->data['current_page'] = basename($_SERVER["SCRIPT_FILENAME"],".php");
        }
        
        public function index() {
            $this->data['current_page'] = "setup";
            $this->data['page_title'] = ucwords("database setup");
            $this->load->view('templates/header',$this->data);
            $this->load->view('admin/database/setup');
            $this->load->view('templates/footer');
        }   
   }
?>
