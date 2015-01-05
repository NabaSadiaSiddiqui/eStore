<?php

class Customers extends CI_Controller {
    function __construct() {
        // Call the Controller constructor
        parent::__construct();
    }

    function index() {
        $this->load->model('customer_model');
        $customers = $this->customer_model->getAll();
        $data['main'] = 'customer/list.php';
        $data['secondary'] = array("customers" => $customers);
        $this->load->view('template.php', $data);
    }

    function create() {
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<p class="error signUp">', '</p>');

        if ($this->form_validation->run('auto/signUp')) {
            $this->load->model('customer_model');

            $customer = new Customer();
            $customer->first = $this->input->get_post('first_name');
            $customer->last = $this->input->get_post('last_name');
            $customer->login = $this->input->get_post('user_login');
            $customer->email = $this->input->get_post('email');
            $customer->password = $this->input->get_post('password');

            $this->customer_model->insert($customer);

            //Then we redirect to the index page again
            if(!session_id()) {
                session_start();
            }
            $this->setUserDetails($customer);

            redirect('store/index', 'refresh');
        }
        else {
            $data['main'] = 'customer/signUp.php';
            $data['secondary'] = array();
            $this->load->view('template.php', $data);
        }
    }

    function verify() {
        $login = $this->input->get_post('user_login');
        $password = $this->input->get_post('password');

        $this->load->model('customer_model');
        $user = $this->customer_model->get($login);

        $error_msg = "<div class='_error'><p>The username or password you entered is incorrect.</p></div>";

        if(empty($user) or $user->get_password() != $password) {
            $data['main'] = 'customer/login.php';
            $data['secondary'] = array("userError" => $error_msg);
            $this->load->view('template.php', $data);
        }
        elseif($user->get_password() == $password) {
            $this->setUserDetails($user);
            if($user->get_login() == "admin") {
                redirect("store/admin", "refresh");
            } else {
                redirect("store/index", "refresh");
            }
        }
    }

    function delete($id) {
        $this->load->model('customer_model');
        if (isset($id))
            $this->customer_model->delete($id);

        //Then we redirect to the index page again
        $this->index();
    }

    function setUserDetails($user) {
        session_start();
        $_SESSION["name"] = $user->get_login();
        $_SESSION["fname"] = $user->get_first();
        $_SESSION["lname"]  = $user->get_last();
        $_SESSION["email"] = $user->get_email();
    }
} 