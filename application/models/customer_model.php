<?php

class Customer_model extends CI_Model {
    function getAll() {
        $query = $this->db->get('customers');
        return $query->result('Customer');
    }

    // get customer from login
    function get($login) {
        $query = $this->db->get_where('customers', array('login' => $login));
        return $query->row(0, 'Customer');
    }

    // get customer from email
    function get_from_email($email) {
        $query = $this->db->get_where('customers', array('email' => $email));
        return $query->row(0, 'Customer');
    }

    function insert($customer) {
        return $this->db->insert('customers', array('first' => $customer->get_first(),
            'last' => $customer->get_last(),
            'login' => $customer->get_login(),
            'email' => $customer->get_email(),
            'password' => $customer->get_password()));
    }

    function delete($id) {
        return $this->db->delete("customers",array('id' => $id));
    }
}

?>