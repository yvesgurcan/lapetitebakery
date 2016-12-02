<?php
/*
The VerifyLogin controller is a special class that runs the check between user credentials and data submitted through a form and redirects the user accordingly.
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
    class VerifyLogin extends CI_Controller {
 
        function __construct() {
            parent::__construct();
            $this->load->helper('url');
            $this->load->model('query');
            $this->data['current_page'] = basename($_SERVER["SCRIPT_FILENAME"],".php");
        }

        function index() {
            // Validate against database
            $username = $this->input->post('user');
            $password = $this->input->post('password');
            
            //query the database
            $result = $this->query->auth($username, $password);

            if($result !== false) {
                foreach($result as $row) {
                        $this->session->user = $row->user;
                        $this->session->access_level = $row->access;
                    
                }
               redirect('dashboard');
            }
            else {
               redirect('login?incorrect'); 
            }
        }
    }
?>