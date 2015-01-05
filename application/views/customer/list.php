<h1 class="admin">All customers</h1>
<?php

if(sizeof($customers)) {
    $attr = array(
        "table_open" => "<table class='admin customers'>"
    );
    $this->table->set_template($attr);

    $th = array("First name", "Last name", "Login ID", "Email", "Password", "");
    $this->table->set_heading($th);
    foreach ($customers as $customer) {
        $id = $customer->id;
        $delete = anchor("customers/delete/$id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'");
        $action = "<span>" . $delete . "</span>";
        $this->table->add_row($customer->get_first(), $customer->get_last(), $customer->get_login(), $customer->get_email(), $customer->get_password(), $action);
    }
    echo $this->table->generate();
    $this->table->clear();  // clear table heading and row data to generate more tables in the future
} else {
    ?>
    <h2 class="admin customers">There are currently no registered customers. Check back later.</h2>
<?php
}
?>