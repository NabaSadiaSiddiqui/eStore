<h1 class="receipt">Invoice</h1>
<div class="receipt">
    <h2 class="receipt">Customer name : <?=$fname . " " . $lname?></h2>
    <h2 class="receipt">Customer email : <?=$email?></h2>
    <h2 class="receipt">Customer ID : <?=$customer_id?></h2>
    <h2 class="receipt">Total : $<?=$total?></h2>
    <?php
        $attr = array(
            "table_open" => "<table class='receipt'>"
        );
        $this->table->set_template($attr);

        $th = array("Product ID", "Product name", "Price", "Quantity");
        $this->table->set_heading($th);

        $ids = array_keys($order_items);
        foreach ($ids as $id) {
            $product = $products[$id][0];
            $quantity = $order_items[$id];
            if($quantity) {
                $this->table->add_row($product->id, $product->name, $product->price, $quantity);
            }
        }
        echo $this->table->generate();
        $this->table->clear();  // clear table heading and row data to generate more tables in the future
    ?>
</div>
<?php
    $attr = array(
        'name' => 'invoicePrint',
        'type' => 'button',
        'content' => 'Print receipt',
        'onClick' => 'printReceipt()',
        'class' => 'receipt'
    );
    echo form_button($attr);
?>
