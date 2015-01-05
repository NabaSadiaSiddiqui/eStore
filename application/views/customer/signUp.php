<?php
    $first_name = array(
        "name" => "first_name",
        "value" => set_value("first_name"),
        "required" => "required",
        "maxlength" => 24,
        "size" => 30,
        "placeholder" => "First name",
        "class" => "signUp"
    );
    $last_name = array(
        "name" => "last_name",
        "value" => set_value("last_name"),
        "required" => "required",
        "maxlength" => 24,
        "size" => 30,
        "placeholder" => "Last name",
        "class" => "signUp"
    );
    $login = array(
        "name" => "user_login",
        "value" => set_value("user_login"),
        "required" => "required",
        "maxlength" => 16,
        "size" => 30,
        "placeholder" => "User ID",
        "class" => "signUp"
    );
    $email = array(
        "name" => "email",
        "value" => set_value("email"),
        "type" => "email",
        "required" => "required",
        "size" => 30,
        "maxlength" => 45,
        "placeholder" => "Email",
        "class" => "signUp"
    );
    $password = array(
        "name" => "password",
        "required" => "required",
        "size" => 30,
        "maxlength" => 16,
        "placeholder" => "Password",
        "class" => "signUp",
        "id" => "pass1",
    );
    $confirm_password = array(
        "name" => "confirm_pass",
        "required" => "required",
        "size" => 30,
        "maxlength" => 16,
        "placeholder" => "Confirm password",
        "class" => "signUp",
        "id" => "pass2",
        "oninput" =>"checkPassword();"
    );
    $go = array(
        "name" => "new_user",
        "value" => "Sign Up",
        "class" => "signUp"
    );
    $attr = array(
        "class" => "signUp"
    );
    echo form_open_multipart('customers/create', $attr);
    echo form_fieldset("New User");
    echo form_error("first_name");
    echo form_input($first_name);
    echo form_error("last_name");
    echo form_input($last_name);
    echo form_error("user_login");
    echo form_input($login);
    echo form_error("email");
    echo form_input($email);
    echo form_error("password");
    echo form_password($password);
    echo form_error("confirm_pass");
    echo form_password($confirm_password);
    echo form_submit($go);
    echo form_fieldset_close();
    echo form_close();
?>