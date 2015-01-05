<?php
    $attr = array(
        "class" => "admin"
    );
    echo form_open_multipart('admin/getTask', $attr);
?>
<p class="admin home">Select a task from the following:</p>
<?php
    echo form_fieldset();
    $attr = array(
        'name' => 'adminAction',
        'value' => 'modProd',
        "id" => "modProd",
        "class" => "admin"
    );
    echo form_radio($attr);
    echo form_label('Add, delete and edit products', 'modProd');;
?>
<br />
<?php
    $attr = array(
        'name' => 'adminAction',
        'value' => 'dispOrders',
        'id' => 'dispOrders',
        "class" => "admin"
    );
    echo form_radio($attr);
    echo form_label('View and delete all finalized orders', 'dispOrders');
?>
<br />
<?php
    $attr = array(
        'name' => 'adminAction',
        'value' => 'remInfo',
        'id' => 'remInfo',
        "class" => "admin"
    );
    echo form_radio($attr);
    echo form_label('View and delete customer information', 'remInfo');
?>
<br />
<?php
    echo form_submit("adminTask", "OK");
    echo form_fieldset_close();
    echo form_close();
?>