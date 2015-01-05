<?php

class Order_model extends CI_Model {

    function getAll() {
        $query = $this->db->get('orders');
        return $query->result('Order');
    }

    function get($id) {
        $query = $this->db->get_where('orders', array('id' => $id));
        return $query->row(0, 'Order');
    }

    function insert($order) {
        $this->db->insert('orders', array('customer_id' => $order->get_customer_id(),
                                            'order_date' => $order->get_order_date(),
                                            'order_time' => $order->get_order_time(),
                                            'total' => $order->get_total(),
                                            'creditcard_number' => $order->get_creditcard_number(),
                                            'creditcard_month' => $order->get_creditcard_month(),
                                            'creditcard_year' => $order->get_creditcard_year()));
        return $this->db->insert_id();  // ID of the last insert query
    }

    function delete($id) {
        return $this->db->delete("orders",array('id' => $id));
    }

    function update($order) {
        $this->db->where('id', $order->id);
        return $this->db->update("orders", array('customer_id' => $order->get_customer_id(),
                                                    'order_date' => $order->get_order_date(),
                                                    'order_time' => $order->get_order_time(),
                                                    'total' => $order->get_total(),
                                                    'creditcard_number' => $order->get_creditcard_number(),
                                                    'creditcard_month' => $order->get_creditcard_month(),
                                                    'creditcard_year' => $order->get_creditcard_year()));
    }
}
?>