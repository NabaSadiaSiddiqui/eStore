<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
    'auto/register' => array(
            array(
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'required|min_length[5]|max_length[12]'
            ),
            array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'required|min_length[4]'
            ),
            array(
                    'field' => 'passconf',
                    'label' => 'Password Confirmation',
                    'rules' => 'required|min_length[4]|matches[password]'
            ),
            array(
                    'field' => 'phone',
                    'label' => 'Phone Number',
                    'rules' => 'required|callback_phone_check'
            )
    ),

    'auto/signUp' => array(
        array(
            'field'   => 'first_name',
            'label'   => 'First name',
            'rules'   => 'required'
        ),
        array(
            'field'   => 'last_name',
            'label'   => 'Last name',
            'rules'   => 'required'
        ),
        array(
            'field'   => 'user_login',
            'label'   => 'User ID',
            'rules'   => 'required|is_unique[customers.login]'
        ),
        array(
            'field'   => 'password',
            'label'   => 'Password',
            'rules'   => 'required|min_length[6]'
        ),
        array(
            'field'   => 'confirm_pass',
            'label'   => 'Password Confirmation',
            'rules'   => 'required|min_length[6]|matches[password]'
        ),
        array(
            'field'   => 'email',
            'label'   => 'Email',
            'rules'   => 'required|is_unique[customers.email]|valid_email'
        )
    ),

    'auto/newProd' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|is_unique[products.name]'
        ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'required'
        ),
        array(
            'field' => 'price',
            'label' => 'Price',
            'rules' => 'required'
        )
    ),

    'auto/checkout' => array(
        array(
            'field' => 'creditcard',
            'label' => 'Credit card number',
            'rules' => 'required|callback_creditcard_valid'
        ),
        array(
            'field' => 'cardExpiration',
            'label' => 'Credit card expiry',
            'rules' => 'required|callback_creditcard_expiry'
        )
    )
);


