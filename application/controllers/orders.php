<?php

class Orders extends CI_Controller {

    function __construct() {
        // Call the Controller constructor
        parent::__construct();
    }

    function index() {
        $this->load->model('order_item_model');
        $order_items = $this->order_item_model->getAll();
        $data['main'] = 'admin/list.php';
        $data['secondary'] = array("order_items" => $order_items);
        $this->load->view('template.php', $data);
    }

    public function creditcard_valid($creditcard) {
        if (preg_match("/^[0-9]{16}$/", $creditcard) == 0 ){
            $this->form_validation->set_message('creditcard_valid', 'Credit card must be 16 characters long');
            return false;
        }
        return true;
    }

    public function creditcard_expiry($expiration) {
        $cardExpires = explode("-", $expiration);
        $ccyear = $cardExpires[0];
        $ccmonth = $cardExpires[1];

        $currmonth = date('m');
        $curryear = date('Y');

        if($ccyear < $curryear) {
            $this->form_validation->set_message('creditcard_expiry', 'Invalid expiration date');
            return false;
        }
        if($ccyear == $curryear and $ccmonth < $currmonth) {
            $this->form_validation->set_message('creditcard_expiry', 'Invalid expiration date');
            return false;
        }
        return true;
    }

    function checkout() {
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<p class="error checkout">', '</p>');

        // get total
        $total = $this->input->get_post("total");

        if ($this->form_validation->run('auto/checkout')) {
            // get order_items (product_id -> quantity)
            if(!session_id()) {
                session_start();
            }
            $order_items = $_SESSION["order_items"];

            // get customer from email
            $email = $this->input->get_post("email");
            $this->load->model('customer_model');
            $customer = $this->customer_model->get_from_email($email);

            // get date, time and extract month and year of card's expiration
            $cardExpires = explode("-", $this->input->get_post("cardExpiration"));
            $ccyear = $cardExpires[0];
            $ccmonth = $cardExpires[1];
            $now = new DateTime();
            $datetime = $now->format('Y-m-d H:i:s');
            $datetime = explode(" " , $datetime);
            $date = $datetime[0];
            $time = $datetime[1];

            // insert order into Order table
            $this->load->model('order_model');
            $order = new Order();
            $order->set_customer_id($customer->id);
            $order->set_order_date($date);
            $order->set_order_time($time);
            $order->set_creditcard_number($this->input->get_post("creditcard"));
            $order->set_creditcard_month($ccmonth);
            $order->set_creditcard_year($ccyear);
            $order->set_total($total);
            $order_id = $this->order_model->insert($order); // returns order_id

            // insert order_item into Order_item table
            $this->load->model('order_item_model');
            $prodId = array_keys($order_items);
            foreach($prodId as $product_id) {
                $quantity = $order_items[$product_id];
                $order_item = new Order_item();
                $order_item->set_order_id($order_id);
                $order_item->set_product_id($product_id);
                $order_item->set_quantity($quantity);
                $this->order_item_model->insert($order_item);
            }

            //Now we show the receipt
            if(!session_id()) {
                session_start();
            }
            $data['customer_id'] = $customer->id;
            $data['fname'] = $_SESSION['fname'];
            $data['lname'] = $_SESSION['lname'];
            $data['email'] = $email;
            $data['total'] = $total;
            $data['order_items'] = $_SESSION["order_items"];
            $data['products'] = $_SESSION['products'];

            $this->unsetShoppingCart();
            $this->emailInvoice($data);
        } else {
            if(!session_id()) {
                session_start();
            }
            $data['main'] = 'order/checkout.php';
            $data['secondary'] = array(
                "fname" => $_SESSION["fname"],
                "lname" => $_SESSION["lname"],
                "email" => $_SESSION["email"],
                "cost" => "$total");
            $this->load->view('template.php', $data);
        }
    }

    function unsetShoppingCart() {
        if(!session_id()) {
            session_start();
        }
        unset($_SESSION["items"]);
        unset($_SESSION["order_items"]);
        unset($_SESSION["products"]);
    }

    function emailInvoice($data) {
        $order_items = $data["order_items"];
        $ids = array_keys($order_items);
        $this->load->model('product_model');
        foreach($ids as $id) {
            $product = $this->product_model->get($id);
            $productTr[] = "<tr><td>" . $product->id . "</td><td>" . $product->name . "</td><td>" . $product->price . "</td><td>" . $order_items[$id] ."</td></tr>";
        }

        $emailBody = "
        <p style='font-weight: bold;'>Invoice</p>
        <div>
            <p>Customer name : " . $data['fname'] . " " . $data['lname'] . "</p>
            <p>Customer email : " . $data['email'] . "</p>
            <p>Customer ID : " . $data['customer_id'] . "</p>
            <p>Total : $" . $data['total'] . "</p>
        </div>
        <table class='receipt'>
        <tr><td>Product ID</td><td>Product name</td><td>Price</td><td>Quantity</td></tr>" . implode("", $productTr) . "</table>";

        // email preferences have been set in the config file ==> no need to initialize
        $this->email->from('naba.sadia.siddiqui@gmail.com', 'Naba Sadia Siddiqui');
        $this->email->to($data['email']);
        $this->email->subject('Confirmation for order');
        $this->email->message($emailBody);
        $this->email->send();
        $this->email->clear();

        $this->genReceipt($data);
    }

    function genReceipt($info) {
        $data['main'] = 'order/receipt';
        $data['secondary'] = $info;
        $this->load->view('template.php', $data);
    }

    function read($order_id) {
        $this->load->model('order_model');
        $order = $this->order_model->get($order_id);
        $data['main'] = 'admin/read.php';
        $data['secondary'] = array("order_detail" => $order);
        $this->load->view('template.php', $data);
    }

    function delete($id) {
        $this->load->model('order_item_model');
        $order_item = $this->order_item_model->get($id);
        $order_id = $order_item->get_order_id();

        // Delete order from orders table
        $this->load->model('order_model');
        if (isset($order_id))
            $this->order_model->delete($order_id);

        // Delete order from order_items table
        $this->order_item_model->delete($id);

        //Then we redirect to the index page again
        $this->index();
    }
} 