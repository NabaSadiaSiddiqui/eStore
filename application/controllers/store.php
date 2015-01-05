<?php

class Store extends CI_Controller {

    function __construct() {
        // Call the Controller constructor
        parent::__construct();

        $config['upload_path'] = './images/product/';
        $config['allowed_types'] = 'gif|jpg|png';
        /*	    	$config['max_size'] = '100';
                    $config['max_width'] = '1024';
                    $config['max_height'] = '768';
        */

        $this->load->library('upload', $config);

        // Load URL helper class
        $this->load->helper('url');
        $this->load->library('table');
    }

    function index() {
        if(!session_id()) {
            session_start();
        }
        if(isset($_SESSION['name']) and $_SESSION['name'] == 'admin') {
            $this->admin();
        } else {
            redirect('inventory/index', 'refresh');
        }
    }

    function processNavBar() {
        if($this->input->post("login")==TRUE) {
            $this->login();
        } elseif($this->input->post('shoppingCart')==TRUE) {
            $this->shoppingCart();
        } elseif($this->input->post('home')==TRUE) {
            $this->index();
        } elseif($this->input->post('logout')==TRUE) {
            $this->logout();
        }
    }


    function login() {
        if(!session_id()) {
            session_start();
        }
        $data['main'] = 'customer/login.php';
        $data['secondary'] = array();
        $this->load->view('template.php', $data);
    }

    function logout() {
        if(!session_id()) {
            session_start();
            session_destroy();
            session_regenerate_id(TRUE);
            session_start();
        }
        $this->unsetSess();
        $this->index();
    }

    function unsetSess() {
        if(!session_id()) {
            session_start();
        }
        if(!isset($_SESSION)){
            unset($_SESSION["items"]);
            unset($_SESSION["order_items"]);
            unset($_SESSION["products"]);
            unset($_SESSION["fname"]);
            unset($_SESSION["lname"]);
            unset($_SESSION["email"]);
            unset($_SESSION["name"]);
        }
    }

    function signUp() {
        $data['main'] = 'customer/signUp.php';
        $data['secondary'] = array();
        $this->load->view('template.php', $data);
    }

    function shoppingCart() {
        $data['main'] = 'customer/shoppingCart.php';
        $data['secondary'] = array();
        $this->load->view('template.php', $data);
    }

    function admin() {
        $data['main'] = 'admin/admin.php';
        $data['secondary'] = array();
        $this->load->view('template.php', $data);
    }
}