<?php

class Order_item_model extends CI_Model {

    function getAll() {
        $query = $this->db->get('order_items');
        return $query->result('Order_item');
    }

    function get($id) {
        $query = $this->db->get_where('order_items', array('id' => $id));
        return $query->row(0, 'Order_item');
    }

    function insert($order_item) {
        return $this->db->insert('order_items', array('order_id' => $order_item->get_order_id(),
            'product_id' => $order_item->get_product_id(),
            'quantity' => $order_item->get_quantity()));
    }

    function delete($id) {
        return $this->db->delete("order_items",array('id' => $id));
    }

    function update($order_item) {
        $this->db->where('id', $order_item->id);
        return $this->db->update("order_items", array('order_id' => $order_item->get_order_id(),
            'product_id' => $order_item->get_product_id(),
            'quantity' => $order_item->get_quantity()));
    }

} 