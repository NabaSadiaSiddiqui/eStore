<h1 class="product edit">Edit Product</h1>

<?php
    echo "<p class='product edit'>" . anchor('inventory/index','Back') . "</p>";

    $attr = array(
        "class" => "product edit"
    );
    echo form_open("inventory/update/$product->id", $attr);
    echo form_fieldset("");
    echo form_label('Name');
    echo form_error('name');
    echo "</br>";
    $inputAttr = array(
        'required' => 'required',
        'size' => '40',
        'name' => 'name',
        'value' => $product->name
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
        'value' => $product->description
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
        'value' => $product->price
    );
    echo form_input($inputAttr);
    echo "</br>";
    echo form_submit('submit', 'Save');
    echo form_fieldset_close();
    echo form_close();
?>
