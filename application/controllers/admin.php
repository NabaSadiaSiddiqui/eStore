<?php
/**
 * Created by PhpStorm.
 * User: nabass
 * Date: 03/11/14
 * Time: 8:00 PM
 */

class Admin extends CI_Controller {

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
    }

    function index() {
        redirect('store/index', 'refresh');
    }

    function getTask() {
        $result = $this->input->post("adminAction");

        $this->load->model('product_model');
        $products = $this->product_model->getAll();
        $data['products']=$products;

        if($result == "modProd") {
            redirect('inventory/index', 'refresh');
        } elseif($result == "dispOrders") {
            redirect('orders/index', 'refresh');
        } elseif($result == "remInfo") {
            redirect('customers/index', 'refresh');
        }
    }

    // add item to cart
    function pAdd($id) {
        $this->load->model('product_model');
        $product = $this->product_model->get($id);
        session_start();
        if(!isset($_SESSION['products'])) {
            $_SESSION['products'] = array($id => array($product));
        } else {
            if(array_key_exists($id, $_SESSION['products'])) {
                array_push($_SESSION['products'][$id], $product);
            } else {
                $_SESSION['products'][$id] = array($product);
            }
        }
        if(!isset($_SESSION['items'])) {
            $_SESSION['items'] = 1;
        } else {
            $_SESSION['items']++;
        }
        redirect('store/index', 'refresh');
    }

    // delete product from cart
    function pDelete($id) {
        echo "$id\n";
        if(!session_id()) {
            session_start();
        }
        $num = sizeof($_SESSION["products"][$id]);
        $_SESSION['items'] -= $num;
        unset($_SESSION["products"][$id]);

        redirect('store/shoppingCart', 'refresh');
    }

    // view product details
    function pDetails($id) {
        $this->load->model('product_model');
        $product = $this->product_model->get($id);
        $data['main'] = 'order/addToBag.php';
        $data['secondary'] = array('product' => $product);
        $this->load->view('template.php', $data);
    }

    // proceed to checkout or login page
    function goToCheckout() {
        if(!session_id()) {
            session_start();
        }

        if(!isset($_SESSION['name'])) { // NEED TO LOG IN TO MAKE TRANSACTIONS!
            $error_msg = "<div class='_error'><p>Log in or register to continue shopping</p></div>";
            $data['main'] = 'customer/login.php';
            $data['secondary'] = array('needToLogin' => $error_msg);
            $this->load->view('template.php', $data);
        } else {
            unset($_POST['submit']);    // $_POST now only contains array(product_id => quantity)
            $finalOrder = $_POST;

            /*
             * Get total cost payable
             */
            $ids = array_keys($finalOrder);
            $this->load->model('product_model');
            $total=0;
            foreach($ids as $id) {
                $quantity = $finalOrder[$id];
                $product = $this->product_model->get($id);
                $total += $quantity * $product->price;
            }

            $_SESSION["order_items"] = $finalOrder;
            $data['main'] = 'order/checkout.php';
            $data['secondary'] = array(
                "fname" => $_SESSION["fname"],
                "lname" => $_SESSION["lname"],
                "email" => $_SESSION["email"],
                "cost" => $total);
            $this->load->view('template.php', $data);
        }
    }

    // completed checkout, emailed receipt and displayed it to user
    function transactionComplete() {
        redirect('store/index', 'refresh');
    }
}