<?php
class Customer {
    public $first;
    public $last;
    public $login;
    public $email;
    public $password;

    public function get_password() {
        return $this->password;
    }

    public function get_login() {
        return $this->login;
    }

    public function get_first() {
        return $this->first;
    }

    public function get_last() {
        return $this->last;
    }

    public function get_email() {
        return $this->email;
    }
}