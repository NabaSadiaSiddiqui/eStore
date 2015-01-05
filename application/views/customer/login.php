<?php
    $user_id = array(
        "name" => "user_login",
        "required" => "required",
        "size" => 30,
        "placeholder" => "User ID",
        "class" => "login"
    );
    $password = array(
        "name" => "password",
        "required" => "required",
        "size" => 30,
        "placeholder" => "Password",
        "class" => "login"
    );
    $go = array(
        "name" => "returning_user",
        "value" => "Log In",
        "class" => "login"
    );
    $attr = array(
        "class" => "login"
    );
    echo form_open_multipart('customers/verify', $attr);
    echo form_fieldset("Returning User");

    if(isset($needToLogin)) {
        echo $needToLogin;
    }

    echo form_input($user_id);
    echo form_password($password);
    echo form_submit($go);

    if(isset($userError)) {
        echo $userError;
    }

    echo form_fieldset_close();
    echo form_close();

    echo "<div id='signUp'>" . anchor('store/signUp','Create an account') . "</div>";
?>
