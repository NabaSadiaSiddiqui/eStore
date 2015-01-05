<h1 class="product add">New Product</h1>

<?php
    echo "<p class='product add'>" . anchor('inventory/index','Back') . "</p>";

    $attr = array(
        "class" => "product add",
        "novalidate" => "novalidate"
    );
    echo form_open_multipart('inventory/create', $attr);
    echo form_fieldset();
    echo form_label('Name');
    echo form_error('name');
    echo "</br>";
    $inputAttr = array(
        'required' => 'required',
        'size' => '40',
        'name' => 'name',
        'value' => set_value('name')
    );
    echo form_input($inputAttr);
    echo "</br>";
    echo form_label('Description');
    echo form_error('description');
    echo "</br>";
    $inputAttr = array(
        'required' => 'required',
        'size' => '40',
        'name' => 'description',
        'value' => set_value('description')
    );
    echo form_input($inputAttr);
    echo "</br>";
    echo form_label('Price');
    echo form_error('price');
    echo "</br>";
    $inputAttr = array(
        'required' => 'required',
        'size' => '40',
        'name' => 'price',
        'value' => set_value('price')
    );
    echo form_input($inputAttr);
    echo "</br>";
    echo form_label('Photo');

    if(isset($fileerror))
        echo $fileerror;
?>

<input type="file" name="userfile" size="20" />
</br>
<?php
    echo form_submit('submit', 'Create');
    echo form_fieldset_close();
    echo form_close();
?>