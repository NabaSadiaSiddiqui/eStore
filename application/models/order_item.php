<?php
class Order_item {
    public $order_id;
    public $product_id;
    public $quantity;

    public function set_order_id($order_id) {
        $this->order_id = $order_id;
    }

    public function set_product_id($product_id) {
        $this->product_id = $product_id;
    }

    public function set_quantity($quantity) {
        $this->quantity = $quantity;
    }

    public function get_order_id() {
        return $this->order_id;
    }

    public function get_product_id() {
        return $this->product_id;
    }

    public function get_quantity() {
        return $this->quantity;
    }
}
