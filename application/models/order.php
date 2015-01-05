<?php
class Order {
    public $customer_id;
    public $order_date;
    public $order_time;
    public $total;
    public $creditcard_number;
    public $creditcard_month;
    public $creditcard_year;

    public function set_customer_id($customer_id) {
        $this->customer_id = $customer_id;
    }

    public function set_order_date($order_date) {
        $this->order_date = $order_date;
    }

    public function set_order_time($order_time) {
        $this->order_time = $order_time;
    }

    public function set_total($total) {
        $this->total = $total;
    }

    public function set_creditcard_number($cc_num) {
        $this->creditcard_number = $cc_num;
    }

    public function set_creditcard_month($cc_mon) {
        $this->creditcard_month = $cc_mon;
    }

    public function set_creditcard_year($cc_year) {
        $this->creditcard_year = $cc_year;
    }

    public function get_customer_id() {
        return $this->customer_id;
    }

    public function get_order_date() {
        return $this->order_date;
    }

    public function get_order_time() {
        return $this->order_time;
    }

    public function get_total() {
        return $this->total;
    }

    public function get_creditcard_number() {
        return $this->creditcard_number;
    }

    public function get_creditcard_month() {
        return $this->creditcard_month;
    }

    public function get_creditcard_year() {
        return $this->creditcard_year;
    }

}