<?php
    $first_name = array(
        "name" => "first_name",
        "readonly" => "readonly",
        "size" => 30,
        "value" => $fname,
        "class" => "checkout"
    );
    $last_name = array(
        "name" => "last_name",
        "readonly" => "readonly",
        "size" => 30,
        "value" => $lname,
        "class" => "checkout"
    );
    $email = array(
        "name" => "email",
        "type" => "email",
        "readonly" => "readonly",
        "size" => 30,
        "value" => $email,
        "class" => "checkout"
    );
    $creditcard = array(
        "name" => "creditcard",
        "value" => set_value("creditcard"),
        "required" => "required",
        "pattern" => "\d{16}",
        "size" => 30,
        "placeholder" => "Credit Card Number",
        "oninvalid" => "this.setCustomValidity('Credit card number must be 16 digits long XXXXXXXXXXXXXXXXXXXX')",
        "class" => "checkout"
    );
    $expiration = array(
        "type" => "month",
        "name" => "cardExpiration",
        "value" => set_value("cardExpiration"),
        "required" => "required",
        "size" => 30,
        "class" => "checkout"
    );
    $total = array(
        "type" => "hidden",
        "name" => "total",
        "value" => "$cost",
        "class" => "checkout"
    );
    $go = array(
        "name" => "checkout",
        "value" => "Checkout",
        "class" => "checkout"
    );
    $attr = array(
        "class" => "checkout",
        "novalidate" => "novalidate"
    );
    echo form_open_multipart('orders/checkout', $attr);
    echo form_fieldset("Checkout", $attr);
    echo form_input($first_name);
    echo form_input($last_name);
    echo form_input($email);
    echo form_error("creditcard");
    echo form_password($creditcard);
    echo form_error("cardExpiration");
    echo form_input($expiration);
    echo form_input($total);
    echo form_submit($go);
    echo form_fieldset_close();
    echo form_close();

?>