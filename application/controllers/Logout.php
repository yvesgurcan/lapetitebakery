<?php
/*
The logout controller allows user to destroy the session.
*/
defined('BASEPATH') OR exit('No direct script access allowed');

    class Logout extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->load->helper('url');
            $this->data['current_page'] = basename($_SERVER["SCRIPT_FILENAME"],".php");
        }
        
        public function index() {
            session_destroy();
            redirect("login?logout");
        }
        
    }
?>